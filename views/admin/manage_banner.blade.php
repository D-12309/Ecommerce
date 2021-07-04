@extends('admin/layout')
@section('container')
@section('banner_select','active')
<?php
if($id>0){
$image_required="";
}else{
$image_required='required';
}
?>

<div class="col-lg-12">
<h1 class="mb-3">Manage banner</h1>
<a href="{{url('admin/banner')}}" ><button type="button" class="btn btn-primary  p-">Back</button></a>
                                <div class="card mt-4">
                                    <div class="card-header">Manage banner</div>
                                    <div class="card-body">
                                       
                                       
                                        <form action="{{route('banner.manage_banner_process')}}" method="post"  enctype="multipart/form-data" novalidate="novalidate" >
                                        @csrf
                                            <div class="form-group">
                                                <label for="btn_txt" class="control-label mb-1" >Button Txt </label>
                                                <input id="btn_txt" name="btn_txt" type="text" class="form-control" value="{{$btn_txt}}" Required>
                                            </div>
                                            @error('btn_txt')
                                            {{$message}}
                                            @enderror
                                            <div class="form-group">
                                                <label for="btn_link" class="control-label mb-1" >Button Link </label>
                                                <input id="btn_link" name="btn_link" type="text" class="form-control" value="{{$btn_link}}" Required>
                                            </div>
                                            @error('btn_link')
                                            {{$message}}
                                            @enderror
                                            <div class="form-group">
               <label for="image" class="control-label mb-1" >banner image</label>
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