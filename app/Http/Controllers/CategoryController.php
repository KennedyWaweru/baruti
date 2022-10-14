<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Storage;
use App\Firework;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('category.index',['categories'=>$categories]);
        //dd($categories);
    }

    public function create(){
        return view('category.create');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:100|unique:categories',
            'description' => 'required|string|max:2000',
            'image' => 'image'
        ]);
        $name = $request->input('name');
        $description = $request->input('description');
        if($request->hasFile('image')){
            //$img_prefix = "category_pic_".$name;

            /* Save image file in local storage */
            //$img = $request->file('image')->store('public/category_images');

            $img_file = $request->file('image');
            $img_name = time().$name;
            $filename = 'category_images/'.$img_name;

            Storage::disk('s3')->put($filename, file_get_contents($img_file));
            //$img = Str::replaceFirst('public','storage',$img);
        }

        $category = new Category;
        $category->name = $name;
        $category->description = $description;
        $category->image = $filename;
        if ($category->save()){
            return redirect()->route('category')->with('success','Category Created Successfully');
        }

    }
    public function show(Category $category){
        //dd($category->id);
        $fireworks = Firework::where('category_id',$category->id)->get();
        return view('category.show',['category'=>$category, 'fireworks'=>$fireworks]);
        //dd($fireworks);
    }
    public function edit(Category $category){
        #$category = Category::findOrFail($id);
        //dd($category);
        return view('category.edit',['category'=>$category]);
    }

    public function update(Request $request, Category $category){
        $request->validate([
            'name'=>'required|string|max:100',
            'description'=>'required|string|max:2000',
            'image' => 'image'
        ]);

        $category -> name = $request->input('name');
        $category -> description = $request->input('description');
        if ($request->hasFile('image')){

            $current_image = $category->image;
            // delete current image
            if($current_image){Storage::delete($current_image);}
            $img = $request->file('image')->store('public/category_images');
            $img = Str::replaceFirst('public','storage',$img);
            $category -> image = $img;
        }
        $category->save();
        return redirect() -> route('category')->with('success','Updated Successfully');
       

    }

    public function destroy(Category $category){
        // delete the product and related files
        //dd($category);
        /*

        Delete from Local storage

        $category_name = $category->name;
        $category_dir = 'public/category_images/'.$category->slug;
        if(Storage::deleteDirectory($category_dir) && $category->delete()){
            return redirect()->route('category.index')->with('success',$category_name.' Deleted');
        }else{
            return redirect()->back()->with('error','Could not delete '.$category_name);
        }

        */

        // Delete from s3 bucket 
        $category_name = $category->name;
        $category_dir = 'category_images/'.$category->slug;
        if(Storage::deleteDirectory($category_dir) && $category->delete()){
            return redirect()->route('category.index')->with('success ',$category_name.' Deleted');
        } else {
            return redirect()->back()->with('error', 'Could not delete '.$category_name);
        }
    }

    public function checkSlug(Request $req){
        $slug = SlugService::createSlug(Category::class, 'slug', $req->name);
        return response()->json(['slug' => $slug]);
    }
}
