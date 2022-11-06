<?php

namespace App\Http\Controllers;

use App\Firework;
use App\Category;
use App\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class FireworkController extends Controller
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
        $categories = Category::all();
        $packages = Package::all();
        return view('fireworks.dashboard',['categories'=>$categories,'packages'=>$packages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
        $categories = Category::pluck('name','id');
        //dd($categories);
        return view('fireworks.create',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* 
            Request has params:
             name,
             slug,
             category,
             price
             video_url
             colors: blue, red, green, yellow, orange, purple
             shots
             height 
             description 
             dp_image
             image
             image1
             image2
                
        */
        // Validate the form request 

    
        $this->validate($request, [
            'name' => 'required|string',
            'slug' => 'required|unique:fireworks',
            'category' => 'required',
            'dp_image' => 'required|image|max:5000',
            'images.*' => 'required|image|max:5000',
            'price' => 'required|integer',
            'video_url' => 'nullable|active_url',
            'shots' => 'integer',
            'height' => 'nullable',
            'stock'=> 'integer',
            'description' => 'max:500'
        ]
        );
         $firework = new Firework;
         $firework->name = $request->input('name');
         // $firework->slug = $request->input('slug');
         $firework->category_id = $request->input('category');
         $firework->price = $request->input('price');

         // Parse the video url. replace "watch?v=" with "embed/"
         $video_url = $request->input('video_url');
         $embed_url = Str::replaceFirst('watch?v=', 'embed/', $video_url);
         $firework->video_url = $embed_url;
         
         $firework->description = $request->input('description');
         $firework->number_of_shots = $request->input('shots');
         $firework->height_altitude = $request->input('height');
         $firework->stock = $request->input('stock');

         // If you have multiple checkboxes in your form, The name of the checkbox field should be appended by [].
        $colors = $request->input('colors');
        $firework->effect_colors = json_encode($colors);
        // Logic for saving the images to filesystem
        $folder_name = Str::of($request->input('name'))->slug();
       
        // s3 bucket 
        $folder_path = 'uploads/'.$folder_name;
        Storage::disk('s3')->makeDirectory($folder_path);
        $image = $request->file('dp_image');
        $path = $folder_path.'/'.time()."_".$folder_name.'.'.$image->getClientOriginalExtension();
        $img = Image::make($image->getRealPath())->resize(300, 300);
        Storage::disk('s3')->put($path, $img->stream());
        
        $firework->image_url = $path;
       
        if($request->hasFile('images')){
            foreach($request->file('images') as $_img){

                // s3 bucket storage
                $path = 'uploads/'.$folder_name.'/'.time().'_'.$folder_name.'.'.$_img->getClientOriginalExtension();
                $image = Image::make($_img->getRealPath())->resize(300,300)->stream();
                Storage::disk('s3')->put($path, $image);
                $image_names[] = $path;
            }
            #var_dump(json_encode($image_names));
            $firework->images = json_encode($image_names);


        }
       
        if ($firework->save()){
            return redirect('/fireworks')->with('success','Upload was successful');
        }else{
            return redirect()->back()->with('error','Could not insert into DB')->withInput();
        }
      // dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Firework  $firework
     * @return \Illuminate\Http\Response
     */
    public function show(Firework $firework)
    {
        //
        #return $firework->all();
        #dd($firework->category_id);
        $related_products = Firework::where('category_id',$firework->category_id)
                                ->where('id','!=',$firework->id)
                                ->inRandomOrder()->limit(3)->get();
        
        return view('fireworks.show',['firework'=>$firework,'related_products'=>$related_products,'product_id'=>$firework->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Firework  $firework
     * @return \Illuminate\Http\Response
     */
    public function edit(Firework $firework)
    {
        //
        $categories = Category::pluck('name','id');
        return view('fireworks.edit', ['firework'=>$firework,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Firework  $firework
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Firework $firework)
    {
        //
        $this->validate($request,
            [
            'name' => 'required|string',
            'category' => 'required',
            'dp_image' => 'image|max:5000',
            'images.*' => 'image|max:5000',
            'price' => 'required|integer',
            'video_url' => 'nullable|active_url',
            'shots' => 'integer',
            'height' => 'nullable',
            'stock' => 'integer',
            'description' => 'max:500'
            ]
        );
       
         $firework = Firework::where('id', $request->id)->first();
         //dd($firework->name);
         $firework->name = $request->input('name');
         $firework->slug = $request->input('slug');
         $firework->category_id = $request->input('category');
         $firework->price = $request->input('price');
         #$firework->video_url = $request->input('video_url');
         
         // Parse the video url. replace "watch?v=" with "embed/"
         $video_url = $request->input('video_url');
         $embed_url = Str::replaceFirst('watch?v=', 'embed/', $video_url);
         $firework->video_url = $embed_url;

         $firework->description = $request->input('description');
         $firework->number_of_shots = $request->input('shots');
         $firework->height_altitude = $request->input('height');
         $firework->stock = $request->input('stock');
         // If you have multiple checkboxes in your form, The name of the checkbox field should be appended by [].
        $colors = $request->input('colors');
        $firework->effect_colors = json_encode($colors);
        // Logic for saving the images to filesystem
        
        $folder_name = $firework->getOriginal('slug');
        
        if($request->hasFile('dp_image')){
            $image = $request->file('dp_image');
            $current_image = $firework->image_url;
            // Update files on s3 bucket
            $image = $request->file('dp_image');
            $path = 'uploads/'.$folder_name.'/'.time()."_".$folder_name.'.'.$image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath())->resize(300, 300);

            Storage::disk('s3')->delete($current_image);
            Storage::disk('s3')->put($path, $img->stream());

            $firework->image_url = $path;
        }else{
            $firework->image_url = $firework->getOriginal('image_url');
        }
        
       
        if($request->hasFile('images')){

            // Delete current files in s3 bucket
            foreach(json_decode($firework->images) as $img_file){
                Storage::disk('s3')->delete($img_file);
            }
            foreach($request->file('images') as $_img){
                // s3 bucket storage
                $path = 'uploads/'.$folder_name.'/'.time().'_'.$folder_name.'.'.$_img->getClientOriginalExtension();
                $image = Image::make($_img->getRealPath())->resize(300,300)->stream();
                Storage::disk('s3')->put($path, $image);

                $image_names[] = $path;
            }
            #var_dump(json_encode($image_names));
            $firework->images = json_encode($image_names);

            // check if name of the product changed so as to move the directory
            $has_name_changed = $firework->isDirty('name');
        }
       
        if ($firework->save()){
            return redirect('/fireworks')->with('success','Product updated successful');
        }else{
            return redirect()->back()->with('error','Could not update the product into DB')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Firework  $firework
     * @return \Illuminate\Http\Response
     */
    public function destroy(Firework $firework)
    {
        // delete the product and related files
        //dd($firework);
        // Delete product and resources from s3 bucket
        $fwork_name = $firework->name;
        $fwork_slug = $firework->slug;
        $fwork_dir = 'uploads/'.$fwork_slug;
        if(Storage::disk('s3')->deleteDirectory($fwork_dir) && $firework->delete()){
            return redirect()->route('fireworks.index')->with('success',$fwork_name." Deleted");
        } else {
            return redirect()->back()->with('error', 'Could not delete '.$fwork_name);
        }
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Firework::class, 'slug', $request->name);
        return response()->json(['slug'=>$slug]);
    }
}
