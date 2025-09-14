<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;


class ProductController extends Controller
{
    public function index(){
        $product = Product::with('category')->get();
        $category = Category::get();
        return view('product.index',compact('product','category'));
    }

    public function create(){

    }

    public function store (Request $request ){

     $request->validate([
    'product_image' => 'required|image|mimes:png,jpg,jpeg,gif|max:2048',
    'product_category' => 'required',
    'product_name' => 'required',
    'product_price' => 'required',
     ]);

     $product_image = $request->file('product_image');
     $imageName = uniqid().'.'.$product_image->getClientOriginalExtension();
     $product_image->move(public_path('uploads'),$imageName);


       Product::create([
           'product_image' => $imageName,
           'product_category' => $request->product_category,
           'product_name' => $request->product_name,
           'product_price' => $request->product_price,
                ]);
        return redirect()->back()->with('success', 'Type added successfully!');
    }

    public function deactive($id){
        $type = Product::find($id);
        $type->status = 0;
        $type->save();
        return back();
    }
    public function active($id){
        $type = Product::find($id);
        $type->status = 1;
        $type->save();
        return back();
    }
    public function show(){

    }
   public function delete($id)
{
    $type = Product::find($id);

    if ($type) {
        $type->delete();
    }

    return back();
}


}
