@extends('admin/layout')
@section('container')
@section('brand_select','active')
<?php
if($id>0){
$image_required="";
}else{
$image_required='required';
}
?>

<div class="col-lg-12">
<h1 class="mb-3">Manage Brand</h1>
<a href="{{url('admin/brand')}}" ><button type="button" class="btn btn-primary  p-">Back</button></a>
                                <div class="card mt-4">
                                    <div class="card-header">Manage brand</div>
                                    <div class="card-body">
                                       
                                       
                                        <form action="{{route('brand.manage_brand_process')}}" method="post"  enctype="multipart/form-data" novalidate="novalidate" >
                                        @csrf
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1" >Brand Name </label>
                                                <input id="name" name="name" type="text" class="form-control" value="{{$name}}" Required>
                                            </div>
                                            @error('name')
                                            {{$message}}
                                            @enderror
                                            <div class="form-group">
               <label for="image" class="control-label mb-1" >Brand image</label>
               <input id="image" name="image" type="file" value="{{$image}}" class="form-control cc-name " {{$image_required}}>
               <img width="100px" height="50px" src="{{asset('storage/media')}}/{{$image}}" alt="">
            </div>
            @error('image')
                                            {{$message}}
                                            @enderror
                                            
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                   Submit
                                                </button>
                                            </div>
                                            <input type="hidden" name="id" value="{{$id}}"/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endsection