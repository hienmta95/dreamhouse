<?php

namespace Modules\Backend\Http\Controllers;

use App\Hoatdong;
use Auth;
use App\Linhvuc;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DataTables;

class LinhvucController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('backend::linhvuc.index');
    }

    public function indexData()
    {
        $linhvucs = Linhvuc::with(['hoatdong'])->get();
        return DataTables::of($linhvucs)
            ->addColumn('count',function ($row){
                return "<p>". count($row->hoatdong) ."</p>";
            })
            ->editColumn('introduce',function ($row){
                return "<p>". mb_substr($row->introduce, 0, 100) ."</p>";
            })
            ->addColumn('action', function($row) {
                return
                    '<form method="POST" action="'. route("backend.linhvuc.destroy", $row->id) .'" onsubmit="return confirm('."'Are you sure you want to delete this item?'".');">
                <input name="_method" value="DELETE" type="hidden">
                <input name="_token" value="'.csrf_token().'" type="hidden">
                <a class="" href="'. route("backend.linhvuc.show", $row->id) .'"><span class="glyphicon glyphicon-eye-open"></span></a>        
                <a class="" href="'. route("backend.linhvuc.edit", $row->id) .'"><span class="glyphicon glyphicon-pencil"></span></a>   
                <button linhvuc="submit" class="submit-with-icon">
                   <span class="glyphicon glyphicon-trash"></span>
                </button>
            </form>';
            })
            ->rawColumns(['action' => 'action', 'introduce' => 'introduce', 'count'=>'count'])
            ->addIndexColumn()
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('backend::linhvuc.create');
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
        $linhvuc = Linhvuc::create($req);

        return redirect()->route('backend.linhvuc.show', $linhvuc->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $linhvuc = Linhvuc::find($id);
        if($linhvuc)
            return view('backend::linhvuc.show', compact(['linhvuc']));
        return redirect()->route('backend.linhvuc.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $linhvuc = Linhvuc::find($id);
        if($linhvuc)
            return view('backend::linhvuc.update', compact(['linhvuc']));
        return redirect()->route('backend.linhvuc.index');
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

        $linhvuc = Linhvuc::find($request->id);
        if($linhvuc) {
            $linhvuc->title = $request->title;
            $linhvuc->slug = $request->slug;
            $linhvuc->introduce = $request->introduce;
            $linhvuc->save();

            return redirect()->route('backend.linhvuc.show',  ['id' =>$request->id]);
        }
        return redirect()->route('backend.linhvuc.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        if(!in_array($id, ['3', '4'])) {
            $linhvuc = Linhvuc::find($id);
            $cates = Hoatdong::where('linhvuc_id', $request->id)->get();
            foreach ($cates as $cate)
                $cate->delete();
            $linhvuc->delete();
            return redirect()->route('backend.linhvuc.index');
        } else {
            return redirect()->route('backend.linhvuc.show', ['id' =>$request->id] )->with('loi','Bạn không thể xoá bản ghi này, vì nó cần xuất hiện ở trên trang chủ.');
        }

    }

}
