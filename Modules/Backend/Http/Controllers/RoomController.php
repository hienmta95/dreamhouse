<?php

namespace Modules\Backend\Http\Controllers;

use App\Category;
use App\Product;
use Auth;
use DB;
use App\Room;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Backend\Components\ImageFile;
use DataTables;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('backend::room.index');
    }

    public function indexData()
    {
        $rooms = Room::with(['category'])->get();
        return DataTables::of($rooms)
            ->addColumn('count',function ($row){
                return "<p>". count($row->category) ."</p>";
            })
            ->editColumn('introduce',function ($row){
                return "<p>". mb_substr($row->introduce, 0, 100) ."</p>";
            })
            ->addColumn('action', function($row) {
                return
                    '<form method="POST" action="'. route("backend.room.destroy", $row->id) .'" onsubmit="return confirm('."'Are you sure you want to delete this item?'".');">
                <input name="_method" value="DELETE" type="hidden">
                <input name="_token" value="'.csrf_token().'" type="hidden">
                <a class="" href="'. route("backend.room.show", $row->id) .'"><span class="glyphicon glyphicon-eye-open"></span></a>        
                <a class="" href="'. route("backend.room.edit", $row->id) .'"><span class="glyphicon glyphicon-pencil"></span></a>   
                <button room="submit" class="submit-with-icon">
                   <span class="glyphicon glyphicon-trash"></span>
                </button>
            </form>';
            })
            ->rawColumns(['action' => 'action', 'introduce' => 'introduce', 'count' => 'count'])
            ->addIndexColumn()
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('backend::room.create');
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
        $room = Room::create($req);

        if($request->image) {
            $arrImage = [];
            foreach ($request->image as $key=>$file) {
                $imageFile = new ImageFile();
                $image_id = $imageFile->saveImage($file);
                $arrImage[$key] = $image_id;
            }
            foreach ($arrImage as $image) {
                $room->images()->attach($image);
            }
        }
        return redirect()->route('backend.room.show', $room->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $room = Room::with(['images'])->find($id);
        if($room)
            return view('backend::room.show', compact(['room']));
        return redirect()->route('backend.room.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $room = Room::with(['images'])->find($id);
        if($room)
            return view('backend::room.update', compact(['room']));
        return redirect()->route('backend.room.index');
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

        $room = Room::find($request->id);
        if($room) {
            $room->title = $request->title;
            $room->slug = $request->slug;
            $room->introduce = $request->introduce;
            $room->save();
            if($request->image) {
                $arrImage = [];
                foreach ($request->image as $key=>$file) {
                    $imageFile = new ImageFile();
                    $image_id = $imageFile->saveImage($file);
                    $arrImage[$key] = $image_id;
                }
                foreach ($arrImage as $image) {
                    $room->images()->attach($image);
                }
            }
            return redirect()->route('backend.room.show',  ['id' =>$request->id]);
        }
        return redirect()->route('backend.room.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        if(!in_array($id, ['1', '2', '3', '4', '5'])) {
            $room = Room::find($id);
            $room->status = 0;
            $room->images()->detach();
            $cates = Category::where('room_id', $request->id)->get();
            foreach ($cates as $cate) {
                $pro_delete = Product::where('category_id', $cate->id)->delete();
                $cate->delete();
            }
            $room->delete();
            $room->save();

            return redirect()->route('backend.room.index');
        } else {
            return redirect()->route('backend.room.show', ['id' =>$request->id] )->with('loi','Bạn không thể xoá bản ghi này, vì nó cần xuất hiện ở trên trang chủ.');
        }

    }

    public function deleteImage(Request $request)
    {
        $image_id = $request->key;
        $room_id = $request->room_id;

        $delete = DB::table('image_room')
            ->where('image_id', $image_id)
            ->where('room_id', $room_id)
            ->delete();

        $imageFile = new ImageFile();
        $image_delete = $imageFile->deleteImage($image_id);
        return $delete;
    }

}
