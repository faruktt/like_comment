<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
     public function index(){
        $category = Category::get();
        return view('category.index',compact('category'));
    }

   public function create(){

   }

    public function store (Request $request){

     $request->validate(['category_name' => 'required',]);

     $date = [
        'category_name' => $request->input('category_name'),
     ];

     if( Category::Create($date)){
         return redirect()->back()->with('success', 'Type added successfully!');
    } else {
        return redirect()->back()->with('error', 'Failed to add type.');
    }

    }

    public function edit(){

    }

    public function update($id){

    }
    public function active($id)
        {
            $type = Category::find($id);
            $type->status = 1;
            $type->save();

            return redirect()->route('category.index')->with('success', 'type Activated');
        }

    public function deactive($id)
        {
            $type = Category::find($id);
            $type->status = 0;
            $type->save();

            return redirect()->route('category.index')->with('success', 'type Activated');
        }

}


