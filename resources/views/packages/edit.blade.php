@extends('layouts.master')

@section('content')
    @auth 
        @can('admin')
            @isset($package)
            <div class="container-fluid">
                <div class="p-5 mb-4 bg-light rounded-3">
                    <div class="container-fluid py-5">
                        <h2 class="display-5 fw-bold text-center">Update Package {{$package->name}}</h2>
                        
                        {!! Form::open(['action' => ['PackageController@update', $package], 'method'=>'PUT', 'enctype'=>'multipart/form-data']) !!}
        
                        <div class="form-group mb-3">
                            {{Form::label('name', 'Package Name',['class'=>'form-label'])}}
                            {{Form::text('name', $package->name,['placeholder'=>"Package Name",'id'=>'name','class'=>'form-control','required','readonly'])}}
                        </div>
        
                        <div class="form-group mb-3">
                            {{Form::label('slug', 'Slug',['class'=>'form-label'])}}
                            {{Form::text('slug', $package->slug,['placeholder'=>"slug",'id'=>'slug','class'=>'form-control','readonly'])}}
                        </div>
        
        
                        <div class="form-group mb-3">
                            {{Form::label('dp_image', 'Display Picture (Optional)',['class'=>'form-label'])}}
                            {{Form::file('dp_image', ['class'=>'form-control form-control-sm', 'type'=>'file'])}}
                        </div>
                        
                        <div class="form-group mb-3">
                            {{Form::label('price', 'Price Kshs',['class'=>'form-label'])}}
                            {{Form::text('price', $package->price,['placeholder'=>"1,000",'id'=>'price','class'=>'form-control','required'])}}
                        </div>
        
                        <div class="row mb-3">
                            <div class="col">
                                {{Form::label('products', 'Available Products',['class'=>'form-label'])}}
                                <div class="row">
                                    @isset($fireworks)
                                    
                                        @foreach($fireworks as $firework)
                                        <div class="col-md-4">
                                            <div class="form-check mb-2">
                                                {{Form::checkbox('products[]', $firework->id)}}
                                                {{Form::label('blue', $firework->name." Kshs ".$firework->price,['class'=>'form-check-label'])}}
                                            </div>
                                        </div>
                                        
                                        @endforeach
                                    
                                    @endisset
                                    
                                </div>
                                
                                
                            </div>
                        </div>
        
                        <div class="form-group">
                            {{Form::label('description', 'Description',['class'=>'form-label'])}}
                            {{Form::textarea('description', $package->description,['placeholder'=>"DESCRIPTION",'id'=>'ckeditor','class'=>'form-control'])}}
                        </div>
        
                        <div class="form-group mb-3">
                            {{Form::label('tags', 'Package Tags (Comma Separated)',['class'=>'form-label'])}}
                            {{Form::text('tags', $package->tags,['placeholder'=>"Birthday Party",'id'=>'tags','class'=>'form-control','required'])}}
                        </div>
        
                        {{Form::submit('Submit',['class'=>'btn btn-primary btn-lg form-control my-3'])}}
                        {!! Form::close() !!}
        
                        {{-- <button class="btn btn-primary btn-lg" type="button">Example button</button> --}}
                    </div>
                </div>
            </div>
            @endisset
        @else 
            <div class="container">
                <div class="row my-2 py-2">
                    <h2 class="text-center">You do not have permission to complete this action.</h2>
                </div>
            </div>
        @endcan
    @endauth
@endsection