<?php

namespace Modules\Backend\Http\Controllers;

use App\Product;
use Auth;
use App\Room;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Backend\Components\ImageFile;
use DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('backend::category.index');
    }

    public function indexData()
    {
        $Categorys = Category::with(['room'])->get();
        return DataTables::of($Categorys)
            ->addColumn('image',function ($row){
                $url = $row->image ? $row->image->url : "";
                return "<img class='index-images' src='".asset('/') .$url."' alt=''>";
            })
            ->addColumn('room',function ($row){
                return "<p>".$row->room->title."</p>";
            })
            ->addColumn('count',function ($row){
                return "<p>1</p>";
            })
            ->editColumn('content',function ($row){
                return "<p>". mb_substr($row->content, 0, 100) ."</p>";
            })
            ->addColumn('action', function($row) {
                return
                    '<form method="POST" action="'. route("backend.category.destroy", $row->id) .'" onsubmit="return confirm('."'Are you sure you want to delete this item?'".');">
                <input name="_method" value="DELETE" type="hidden">
                <input name="_token" value="'.csrf_token().'" type="hidden">
                <a class="" href="'. route("backend.category.show", $row->id) .'"><span class="glyphicon glyphicon-eye-open"></span></a>        
                <a class="" href="'. route("backend.category.edit", $row->id) .'"><span class="glyphicon glyphicon-pencil"></span></a>   
                <button Category="submit" class="submit-with-icon">
                   <span class="glyphicon glyphicon-trash"></span>
                </button>
            </form>';
            })
            ->rawColumns(['action' => 'action', 'content' => 'content', 'count'=>'count', 'room'=>'room', 'image'=>'image'])
            ->addIndexColumn()
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $room = Room::all();
        return view('backend::category.create', compact('room'));
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
            'room_id' => 'required',
        ]);

        $req = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->image;
            $imageFile = new ImageFile();
            $image_id = $imageFile->saveImage($file);
        }
        $req['image_id'] = $image_id;
        $Category = Category::create($req);

        return redirect()->route('backend.category.show', $Category->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $category = Category::with(['room'])->find($id);
        if($category)
            return view('backend::category.show', compact(['category']));
        return redirect()->route('backend.category.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $category = Category::with(['room', 'image'])->find($id);
        $room = Room::all();
        if($category)
            return view('backend::category.update', compact(['category', 'room']));
        return redirect()->route('backend.category.index');
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
            'room_id' => 'required',
        ]);

        $category = Category::find($request->id);
        if($category) {
            $category->title = $request->title;
            $category->slug = $request->slug;
            $category->room_id = $request->room_id;
            $category->content = $request->content;
            if ($request->hasFile('image')) {
                $file = $request->image;
                $imageFile = new ImageFile();
                $image_id = $imageFile->updateImage($file, $category->image_id);
            } else {
                $image_id = $request->image_old;
            }
            $category->save();

            return redirect()->route('backend.category.show',  ['id' =>$request->id]);
        }
        return redirect()->route('backend.category.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $category = Category::find($request->id);
        $pro_delete = Product::where('category_id', $category->id)->delete();
        $image_id = $category->image_id;
        $imageFile = new ImageFile();
        $image_delete = $imageFile->deleteImage($image_id);
        $category->delete();

        return redirect()->route('backend.category.index');
    }

    public function ajax(Request $request)
    {
        $room_id = $request->room_id ? $request->room_id : 0;
        $response = '';
        if($room_id != 0)
            $category = Category::where('room_id', $room_id)->get();
        else
            $category = Category::all();

        if(count($category) == 0) {
            $response .= '<option value="">Chọn</option>';
            return response()->json(compact('response'), 200);
        }

        foreach ($category as $item)
        {
            $response .= '<option value="'.$item->id.'">'.$item->title.'</option>';
        }

        return response()->json(compact('response'), 200);
    }

}
