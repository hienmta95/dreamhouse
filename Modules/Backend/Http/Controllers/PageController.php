<?php

namespace Modules\Backend\Http\Controllers;

use App\Linhvuc;
use Auth;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DataTables;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('backend::page.index');
    }

    public function indexData()
    {
        $pages = Page::all();
        return DataTables::of($pages)
            ->editColumn('kichhoat',function ($row){
                $abc = $row->kichhoat == 1 ? 'yes' : 'no' ;
                return "<p>". $abc ."</p>";
            })
            ->editColumn('content',function ($row){
                return "<p>". mb_substr($row->content, 0, 100) ."</p>";
            })
            ->addColumn('action', function($row) {
                return
                    '<form method="POST" action="'. route("backend.page.destroy", $row->id) .'" onsubmit="return confirm('."'Are you sure you want to delete this item?'".');">
                <input name="_method" value="DELETE" type="hidden">
                <input name="_token" value="'.csrf_token().'" type="hidden">
                <a class="" href="'. route("backend.page.show", $row->id) .'"><span class="glyphicon glyphicon-eye-open"></span></a>        
                <a class="" href="'. route("backend.page.edit", $row->id) .'"><span class="glyphicon glyphicon-pencil"></span></a>   
                <button page="submit" class="submit-with-icon">
                   <span class="glyphicon glyphicon-trash"></span>
                </button>
            </form>';
            })
            ->rawColumns(['action' => 'action', 'content' => 'content', 'kichhoat'=>'kichhoat'])
            ->addIndexColumn()
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('backend::page.create');
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
        ]);

        $req = $request->all();
        $page = Page::create($req);

        return redirect()->route('backend.page.show', $page->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $page = Page::find($id);
        if($page)
            return view('backend::page.show', compact(['page']));
        return redirect()->route('backend.page.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $page = Page::find($id);
        if($page)
            return view('backend::page.update', compact(['page']));
        return redirect()->route('backend.page.index');
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
        ]);

        $page = Page::find($request->id);
        if($page) {
            $page->title = $request->title;
            $page->slug = $request->slug;
            $page->kichhoat = $request->kichhoat;
            $page->content = $request->content;
            $page->save();

            return redirect()->route('backend.page.show',  ['id' =>$request->id]);
        }
        return redirect()->route('backend.page.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        if(!in_array($id, ['1', '2', '5', '6'])) {
            $page = Page::find($id);
            $page->delete();

            return redirect()->route('backend.page.index');
        } else {
            return redirect()->route('backend.page.show', ['id' =>$request->id] )->with('loi','Bạn không thể xoá bản ghi này, vì nó cần xuất hiện ở trên trang chủ.');
        }

    }

}
