<?php

namespace Modules\Frontend\Http\Controllers;

use App\Lienhe;
use App\Product;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Slide;
use App\Linhvuc;
use App\Hoatdong;
use App\Room;
use App\Page;
use App\Category;
use App\User;
use App\Notifications\ToUser;
use App\Notifications\ToAdmin;


class FrontendController extends Controller
{
    private $rooms;
    protected $mail_admin = 'hien.kbhbt@gmail.com';

    function __construct(Request $request)
    {
        $linhvucSlug = [];
        $linhvucMenu = Linhvuc::get()->toArray();
        foreach ($linhvucMenu as $linhvuc) {
            $linhvucSlug[$linhvuc['id']]['slug'] = $linhvuc['slug'];
            $linhvucSlug[$linhvuc['id']]['title'] = $linhvuc['title'];
        }

        $pageSlug = [];
        $pageData = Page::get()->toArray();
        foreach ($pageData as $page) {
            $pageSlug[$page['id']]['slug'] = $page['slug'];
            $pageSlug[$page['id']]['title'] = $page['title'];
        }

        $roomMenu = Room::with(['category', 'images'])->get()->toArray();
        $this->rooms = $roomMenu;

        view()->share('roomMenu', $roomMenu);
        view()->share('pageSlug', $pageSlug);
        view()->share('linhvucSlug', $linhvucSlug);
    }

    public function homepage(Request $request)
    {
        // slide
        $slides = [];
        $slideObj = Slide::with(['image'])->orderBy('id', 'desc')->get();
        foreach ($slideObj as $key=>$item)
        {
            $slides[$key]['id'] = $item->id ? $item->id : "";
            $slides[$key]['tieude'] = $item->name ? $item->name : "";
            $slides[$key]['image'] = $item->image->url ? asset('/').$item->image->url : asset('/')."/images/slide3.jpg";
        }

        // da thiet ke
        $congtrinhdathuchien = $this->getHoatDong('cong-trinh-da-thuc-hien', 4, 5);
        $duandathietke = $this->getHoatDong('du-an-da-thiet-ke', 3, 3);

//        $roomSlug = [];
//        foreach ($this->rooms as $room) {
//            $roomSlug[$room['id']]['slug'] = $room['slug'];
//            $roomSlug[$room['id']]['title'] = $room['title'];
//        }

        $section = [];
        $sections = Section::with('image')->get();
        foreach($sections as $key=>$item) {
            $section[$item->position][$key]['text1'] = $item->text1;
            $section[$item->position][$key]['text2'] = $item->text2;
            $section[$item->position][$key]['link'] = $item->link;
            $section[$item->position][$key]['image'] = asset('/') . $item->image->url;
        }

        return view('frontend::pages.trangchu', compact('slides', 'congtrinhdathuchien', 'duandathietke', 'section'));
    }

    public function getHoatDong($slug, $id_linhvuc, $limit)
    {
        $array = [ 'linhvuc' => [], 'list'=>[] ] ;
        $linhvucObj = Linhvuc::where('slug', $slug)
            ->orWhere('id', $id_linhvuc)->first();
        $idObj = $linhvucObj ? $linhvucObj->id : $id_linhvuc;
        $hoatdongObj = Hoatdong::where('linhvuc_id', $idObj)
            ->orderBy('id', 'desc')
            ->limit($limit)
            ->get();

        foreach ($hoatdongObj as $key=>$item)
        {
            $array['list'][$key]['id'] = $item->id ? $item->id : "";
            $array['list'][$key]['title'] = $item->title ? $item->title : "";
            $array['list'][$key]['slug'] = $item->slug ? $item->slug : "";
            $array['list'][$key]['date'] = $item->updated_at ? $item->updated_at->format('d/m/Y') : "01/01/2019";
            $array['list'][$key]['image'] = $item->image->url ? asset('/').$item->image->url : asset('/')."/images/slide3.jpg";
        }
        $array['linhvuc']['id'] = $idObj;
        $array['linhvuc']['slug'] = $linhvucObj->slug;
        $array['linhvuc']['title'] = $linhvucObj->title;

        return $array;
    }

    public function getRoom(Request $request)
    {
        $id = $request->id;

        $data = [];
        $roomObj = Room::with(['images', 'category'])->where('id', $id)->first();
        if(!empty($roomObj)) {
            $data['id'] = $roomObj->id;
            $data['title'] = $roomObj->title;
            $data['slug'] = $roomObj->slug;
            $data['introduce'] = $roomObj->introduce;

            foreach ($roomObj->images as $key=>$item)
            {
                $data['images'][$key]['id'] = $item->id;
                $data['images'][$key]['url'] = $item->url;
            }
            foreach ($roomObj->category as $key=>$item)
            {
                $data['category'][$key]['id'] = $item->id;
                $data['category'][$key]['title'] = $item->title;
                $data['category'][$key]['slug'] = $item->slug;
                $data['category'][$key]['image'] = asset('/').$item->image->url;
            }

            return view('frontend::pages.room', compact('data'));
        }

        return view('frontend::pages.404');
    }

    public function getLienhethanhcong(Request $request)
    {
        return view('frontend::pages.lienhethanhcong');
    }

    public function getLienhe(Request $request)
    {
        return view('frontend::pages.lienhe');
    }

    public function postLienhe(Request $request)
    {
        $req = $request->all();
        $create = Lienhe::create($req);

        $this->sendMailUser($request->email, $request->all());
        $this->sendMailAdmin($this->mail_admin, $request->all());

        if($create)
            return redirect()->route('frontend.get.thanhcong');
        return view('frontend::pages.lienhe');
    }

    public function sendMailUser($email, $data)
    {
        $user = new User();
        $user->email = $email;
        $user->notify(new ToUser($data));
    }

    public function sendMailAdmin($email, $data)
    {
        $user = new User();
        $user->email = $email;
        $user->notify(new ToAdmin($data));
    }

    public function getCategory(Request $request)
    {
        $id = $request->id;
        $data = Category::with(['room', 'image', 'product' => function ($query) {
            $query->with(['images']);
            $query->orderBy('id', 'desc');
        }])
            ->where('id', $id)
            ->first();
        if(!empty($data)) {
            return view('frontend::pages.category', compact('data'));
        }
        return view('frontend::pages.404');
    }

    public function getProduct(Request $request)
    {
        $id = $request->id;
        $data = Product::with(['images', 'category' => function($query) {
            $query->with(['room']);
        }])
            ->where('id', $id)
            ->first();
        if(!empty($data)) {
            $dataRelate = Product::with(['images'])
                ->where('category_id', $data['category_id'])
                ->orderBy('id', 'desc')
                ->get()->toArray();

            return view('frontend::pages.product', compact('data','dataRelate'));
        }
        return view('frontend::pages.404');
    }

    public function getPageHoatdong(Request $request)
    {
        $id = $request->id;
        $data = Hoatdong::with(['image', 'linhvuc'])
            ->where('id', $id)
            ->first();
        if(!empty($data)) {
            $dataRelate = Hoatdong::with(['image'])
                ->where('linhvuc_id', $data['linhvuc']['id'])
                ->orderBy('id', 'desc')
                ->get()
                ->toArray();

            return view('frontend::pages.hoatdong', compact('data','dataRelate'));
        }
        return view('frontend::pages.404');
    }

    public function getPageLinhvuc(Request $request)
    {
        $id = $request->id;
        $linhvuc = Linhvuc::where('id', $id)->first();
        if(!empty($linhvuc)) {
            $data = Hoatdong::with(['image'])
                ->where('linhvuc_id', $linhvuc['id'])
                ->orderBy('id', 'desc')
                ->paginate(10);

            return view('frontend::pages.linhvuc', compact('data','linhvuc'));
        }
        return view('frontend::pages.404');
    }

    public function getSearch(Request $request)
    {
        $keyword = $request->keyword;
        $request->flashOnly(['keyword']);
        $key = preg_replace("/[^a-zA-Z0-9]+/", "", $keyword);

        $data = Product::with(['images'])
            ->where('title', 'like', '%'.$key.'%')
            ->orderBy('id', 'desc')
            ->paginate(12);

        return view('frontend::pages.search', compact('data','keyword'));
    }

    public function getPage(Request $request)
    {
        $id = $request->id;
        $data = Page::where('kichhoat', '!=', 0)->where('id', $id)->first();
        if(!empty($data)) {
            $dataNoibat = Hoatdong::with(['image'])
                ->where('noibat', 1)
                ->orderBy('id', 'desc')
                ->limit(5)
                ->get()->toArray();

            return view('frontend::pages.page', compact('data', 'dataNoibat'));
        }

        return view('frontend::pages.404');
    }

}
