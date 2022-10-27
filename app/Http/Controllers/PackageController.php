<?php

namespace App\Http\Controllers;

use App\Package;
use App\Firework;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{

    public function __construct(){
        $this->middleware(['auth','can:admin'])->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
        return view('packages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $fireworks = Firework::where('stock', '>', 0)->get();
        return view('packages.create',['fireworks'=>$fireworks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     $this->validate($request,[
        'name'=>'required|max:200',
        'slug'=>'required|unique:packages',
        'price'=>'int|required',
        'products'=>'required|array|min:2',
        'description'=>'required|string'
    ]);

    $package_name = $request->name;
    $package_price = $request->price;
    $package_description = $request->description;
    if($request->hasFile('dp_image')){
        /* TODO: Implement Cloud Storage */
        $folder_name = Str::of($request->input('name'))->slug();
        Storage::disk('s3')->makeDirectory('uploads/'.$folder_name);
        $package_image = $request->file('dp_image');

        $ext = $package_image->getClientOriginalExtension();
        $path = 'uploads/'.$folder_name.'/'.time()."_".$folder_name.'.'.$ext;

        $img = Image::make($package_image->getRealPath())->resize(300, 300);
        Storage::disk('s3')->put($path, $img->stream());

        // Image::make($package_image->getRealPath())->resize(300,300)->save(public_path($path));

    }
    $products = Firework::findMany($request->products);
    $original_package_price = 0;
    $products_stock = [];
    foreach($products as $product){
        $original_package_price += $product->price;
        $products_stock[] = $product->stock;
    }
    if(((int)$package_price >= (int)$original_package_price)){
        //dd('Not cool');
        return redirect()->back()->with('error','Price cannot be higher than original price')->withInput();
    }
    $package_stock = min($products_stock);

    $tags = $request->input('tags');
    $tags_array = explode(',',$tags);
    $package_tags=[];
    foreach($tags_array as $tag){
        $package_tags[] = trim($tag);
    }
    $package_tags_json = json_encode($package_tags);
    $package = new Package;
    $package->name=$package_name;
    $package->price=$package_price;
    $package->original_price=$original_package_price;
    $package->description=$package_description;
    $package->image_url= isset($path) ? $path : 'NULL';
    $package->tags=$package_tags_json;
    $package->stock=$package_stock;
    $package->save();

    $package->fireworks()->attach($products);
    dd($package);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
        //dd($package);
        return view('packages.show',['package'=>$package]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        //
        return view('packages.edit',['package'=>$package]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        // delete package from db and resources in s3 bucket
        $folder_name = 'uploads/'.Str::of($package->name)->slug();
        $dir_exists = Storage::disk('s3')->exists($folder_name);
        if(!$dir_exists){
            $package->delete();
        }

        if(Storage::disk('s3')->deleteDirectory($folder_name) && $package->delete() ){
            return redirect()->route('fireworks.index')->with('success', $package->name.' has been deleted');
        }else{
            return redirect()->back()->with('error', $package->name.' Could not be deleted');
        }
    }
    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Package::class, 'slug', $request->name);
        return response()->json(['slug'=>$slug]);
    }
}
