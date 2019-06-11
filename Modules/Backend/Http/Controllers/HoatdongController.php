<?php

namespace Modules\Backend\Http\Controllers;

use App\Linhvuc;
use Auth;
use App\Hoatdong;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Backend\Components\ImageFile;
use DataTables;

class HoatdongController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('backend::hoatdong.index');
    }

    public function indexData()
    {
        $hoatdongs = hoatdong::with(['linhvuc', 'image'])->get();
        return DataTables::of($hoatdongs)
            ->addColumn('image',function ($row){
                $url = $row->image ? $row->image->url : "";
                return "<img class='index-images' src='".asset('/') .$url."' alt=''>";
            })
            ->addColumn('linhvuc',function ($row){
                return "<p>".$row->linhvuc->title."</p>";
            })
            ->addColumn('ngaythang',function ($row){
                $ngay = $row->ngaythang ? $row->ngaythang : "01/01/2019";
                return "<p>". $ngay ."</p>";
            })
            ->editColumn('noibat',function ($row){
                $abc = $row->noibat == 1 ? 'yes' : 'no' ;
                return "<p>". $abc ."</p>";
            })
            ->editColumn('content',function ($row){
                return "<p>". mb_substr($row->content, 0, 100) ."</p>";
            })
            ->addColumn('action', function($row) {
                return
                    '<form method="POST" action="'. route("backend.hoatdong.destroy", $row->id) .'" onsubmit="return confirm('."'Are you sure you want to delete this item?'".');">
                <input name="_method" value="DELETE" type="hidden">
                <input name="_token" value="'.csrf_token().'" type="hidden">
                <a class="" href="'. route("backend.hoatdong.show", $row->id) .'"><span class="glyphicon glyphicon-eye-open"></span></a>        
                <a class="" href="'. route("backend.hoatdong.edit", $row->id) .'"><span class="glyphicon glyphicon-pencil"></span></a>   
                <button hoatdong="submit" class="submit-with-icon">
                   <span class="glyphicon glyphicon-trash"></span>
                </button>
            </form>';
            })
            ->rawColumns(['action' => 'action', 'content' => 'content', 'linhvuc'=>'linhvuc', 'noibat'=>'noibat', 'image'=>'image', 'ngaythang'=>'ngaythang'])
            ->addIndexColumn()
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $linhvuc = Linhvuc::all();
        return view('backend::hoatdong.create', compact('linhvuc'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'image' => 'required',
            'ngaythang' => 'required',
            'linhvuc_id' => 'required',
        ]);

        $req = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->image;
            $imageFile = new ImageFile();
            $image_id = $imageFile->saveImage($file);
        }
        $req['image_id'] = $image_id;
        $hoatdong = Hoatdong::create($req);

        return redirect()->route('backend.hoatdong.show', $hoatdong->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $hoatdong = Hoatdong::with(['linhvuc', 'image'])->find($id);
        if($hoatdong)
            return view('backend::hoatdong.show', compact(['hoatdong']));
        return redirect()->route('backend.hoatdong.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $hoatdong = Hoatdong::with(['linhvuc', 'image'])->find($id);
        $linhvuc = Linhvuc::all();
        if($hoatdong)
            return view('backend::hoatdong.update', compact(['hoatdong', 'linhvuc']));
        return redirect()->route('backend.hoatdong.index');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'linhvuc_id' => 'required',
            'ngaythang' => 'required',
        ]);

        $hoatdong = Hoatdong::find($request->id);
        if($hoatdong) {
            $hoatdong->title = $request->title;
            $hoatdong->slug = $request->slug;
            $hoatdong->linhvuc_id = $request->linhvuc_id;
            $hoatdong->noibat = $request->noibat;
            $hoatdong->content = $request->content;
            $hoatdong->ngaythang = $request->ngaythang;
            if ($request->hasFile('image')) {
                $file = $request->image;
                $imageFile = new ImageFile();
                $image_id = $imageFile->updateImage($file, $hoatdong->image_id);
            } else {
                $image_id = $request->image_old;
            }
            $hoatdong->save();

            return redirect()->route('backend.hoatdong.show',  ['id' =>$request->id]);
        }
        return redirect()->route('backend.hoatdong.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $hoatdong = Hoatdong::find($request->id);
        $image_id = $hoatdong->image_id;
        $imageFile = new ImageFile();
        $image_delete = $imageFile->deleteImage($image_id);
        $hoatdong->delete();

        return redirect()->route('backend.hoatdong.index');
    }

}
