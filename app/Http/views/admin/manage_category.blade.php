@extends('admin/layout')
@section('container')
@section('category_select','active')
<?php
if($id>0){
$image_required="";
}else{
$image_required='required';
}
?>

<div class="col-lg-12">
<h1 class="mb-3">Add Category</h1>
<a href="{{url('admin/category')}}" ><button type="button" class="btn btn-primary  p-">Back</button></a>
                                <div class="card mt-4">
                                    <div class="card-header">Add Category</div>
                                    <div class="card-body">
                                       
                                       
                                        <form action="{{route('category.manage_category_process')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                        @csrf
                                            <div class="form-group">
                                                <label for="category_name" class="control-label mb-1" >Category Name </label>
                                                <input id="category_name" name="category_name" type="text" class="form-control" value="{{$category_name}}" Required>
                                            </div>
                                            @error('category_name')
                                            {{$message}}
                                            @enderror
                                            <div class="form-group">
                                                <label for="category_slug" class="control-label mb-1" >Category Slug</label>
                                                <input id="category_slug" name="category_slug" type="text" value="{{$category_slug}}" class="form-control cc-name " Required>
                                             
                                            </div>
                                            @error('category_slug')
                                            {{$message}}
                                            @enderror
                                            <div class="form-group">
                     <label for="parent_category" class="control-label mb-1" > parent_category</label>
                     <select name="parent_category" id="parent_category" class="form-control cc-name">
                        <option value="0">select Category</option>
                        @foreach($category as $list)
                        @if($parent_category==$list->id)
                        <option selected value="{{$list->id}}">
                           @else
                        <option value="{{$list->id}}">
                           @endif
                           {{$list->category_name}}
                        </option>
                        @endforeach
                     </select>
                  
                  </div>
                  <div class="form-group">
               <label for="image" class="control-label mb-1" > image</label>
               <input id="image" name="image" type="file" value="{{$image}}" class="form-control cc-name " {{$image_required}}>
               @if($image!='')
               <img width="100px" height="50px" src="{{asset('storage/media')}}/{{$image}}" alt="">
                        @endif
            </div>
            <div class="form-group">
                                                <label for="category_slug" class="control-label mb-1" >Are showing in Home page</label>
                                                <input id="is_check" name="is_check" type="checkbox" {{$is_select}}>
                                             
                                            </div>
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