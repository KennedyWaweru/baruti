<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Firework;
use Cviebrock\EloquentSluggable\Services\SlugService;


class ProductController extends Controller
{
	 public function __construct(){
         //$this->middleware('auth')->except('index','show');
    }

    public function index(){
    	// this will display a list of all the products
    	//return view('products.dashboard');
         return Firework::all();
    }

    public function create(){
    	return view('products.create');
    	// this will upload a new product to the list of products
    }

    public function store(Request $request, Product $product){
    	// this will record a new product that's being added

        // form validation
        $request->validate([
            'name' => ['required', ],
            'slug' => ['required', 'unique:products', 'max:255'],
            'description' => ['required', 'max:1000','string'],
            'price' => ['required','int'],
            'stock' => ['required','int'],
            'quantity' => ['required','int']
        ]);
        dd($request->all());
    }

    public function show(Product $product){
    	// This will display a specific product and it's details
        return $product;
    }

    public function edit(Product $product){
    	// this will edit or modify the content of an existing product
    }

    public function update(Request $request, Product $product){
    	// This will update the details in the d.b and storage with new details of an existing product.
    }

    public function destroy(Product $product){
    	// This will remove existing products from the d.b and from the relevant files in storage.
    }

    public function upload(Request $request){
    	// To update images through the wysiwyg
    	if($request->hasFile('upload')) {
        //get filename with extension
        $filenamewithextension = $request->file('upload')->getClientOriginalName();

        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

        //get file extension
        $extension = $request->file('upload')->getClientOriginalExtension();

        //filename to store
        $filenametostore = $filename.'_'.time().'.'.$extension;

        //Upload File
        $request->file('upload')->storeAs('public/uploads', $filenametostore);

        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url = asset('storage/uploads/'.$filenametostore); 
        $msg = 'Image successfully uploaded'; 
        $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

        // Render HTML output 
        @header('Content-type: text/html; charset=utf-8'); 
        echo $re;
    }
    }

    public function checkSlug(Request $req){
        $slug = SlugService::createSlug(Product::class, 'slug', $req->name);
        return response()->json(['slug' => $slug]);
    }
}
