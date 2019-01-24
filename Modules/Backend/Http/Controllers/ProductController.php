<?php

namespace Modules\Backend\Http\Controllers;

use Auth;
use App\Room;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Backend\Components\ImageFile;
use DataTables;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('backend::product.index');
    }

    public function indexData()
    {
        $products = product::with(['category'])->get();
        return DataTables::of($products)
            ->addColumn('category',function ($row){
                $abc = $row->category ? $row->category->title : "";
                return "<p>".$abc."</p>";
            })
            ->addColumn('action', function($row) {
                return
                    '<form method="POST" action="'. route("backend.product.destroy", $row->id) .'" onsubmit="return confirm('."'Are you sure you want to delete this item?'".');">
                <input name="_method" value="DELETE" type="hidden">
                <input name="_token" value="'.csrf_token().'" type="hidden">
                <a class="" href="'. route("backend.product.show", $row->id) .'"><span class="glyphicon glyphicon-eye-open"></span></a>        
                <a class="" href="'. route("backend.product.edit", $row->id) .'"><span class="glyphicon glyphicon-pencil"></span></a>   
                <button product="submit" class="submit-with-icon">
                   <span class="glyphicon glyphicon-trash"></span>
                </button>
            </form>';
            })
            ->rawColumns(['action' => 'action', 'category'=>'category'])
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
        $category = Category::all();
        return view('backend::product.create', compact('room', 'category'));
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
            'image' => 'required',
            'slug' => 'required',
            'category_id' => 'required',
        ]);

        $req = $request->all();
        $product = Product::create($req);

        if($request->image) {
            $arrImage = [];
            foreach ($request->image as $key=>$file) {
                $imageFile = new ImageFile();
                $image_id = $imageFile->saveImage($file);
                $arrImage[$key] = $image_id;
            }

            foreach ($arrImage as $image) {
                $product->images()->attach($image);
            }
        }

        return redirect()->route('backend.product.show', $product->id);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $id = $request->id;
        $product = Product::with(['category', 'images'])->find($id);
        if($product)
            return view('backend::product.show', compact(['product']));
        return redirect()->route('backend.product.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $product = Product::with(['category', 'images'])->find($id);
        $category = Category::all();
        $room = Room::all();
        if($product)
            return view('backend::product.update', compact(['product', 'category', 'room']));
        return redirect()->route('backend.product.index');
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
            'category_id' => 'required',
        ]);

        $product = Product::find($request->id);
        if($product) {
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->price = $request->price;
            $product->masanpham = $request->masanpham;
            $product->baohanh = $request->slug;
            $product->kichthuoc = $request->slug;
            $product->status = $request->status;
            $product->category_id = $request->category_id;
            $product->description = $request->description;
            $product->chatlieu = $request->chatlieu;
            $product->save();
            if($request->image) {
                $arrImage = [];
                foreach ($request->image as $key=>$file) {
                    $imageFile = new ImageFile();
                    $image_id = $imageFile->saveImage($file);
                    $arrImage[$key] = $image_id;
                }
                foreach ($arrImage as $image) {
                    $product->images()->attach($image);
                }
            }

            return redirect()->route('backend.product.show',  ['id' =>$request->id]);
        }
        return redirect()->route('backend.product.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $product = Product::find($request->id);
        $product->images()->detach();
        $product->delete();

        return redirect()->route('backend.product.index');
    }

    public function deleteImage(Request $request)
    {
        $image_id = $request->key;
        $product_id = $request->product_id;

        $delete = DB::table('image_product')
            ->where('image_id', $image_id)
            ->where('product_id', $product_id)
            ->delete();

        $imageFile = new ImageFile();
        $image_delete = $imageFile->deleteImage($image_id);
        return $delete;
    }

    public function uploadImage(Request $request)
    {
        return 1;
    }

}
