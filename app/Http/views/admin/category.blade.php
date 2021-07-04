
@extends('admin/layout')
@section('container')
@section('category_select','active')
<h1>Category</h1>
<br><br>
{{session('msg')}}
<a href="category/manage_category" class="ml-auto "><button type="button" class="btn btn-primary p-2">Add Category</button></a>


<div class="col-lg-12 mt-4">
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Category Name</th>
                                                <th>Category Slug</th>
                                                <th>Action</th>

                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $list)
                                        <tr>
                                                <td>{{$list->id}}</td>
                                                <td>{{$list->category_name}}</td>
                                                <td>{{$list->category_slug}}</td>
                                                <td><a href="{{url('admin/category/delete/')}}/{{$list->id}}"><button type="button" class="btn btn-danger p-2">Delete</button></a>

                                            <a href="{{url('admin/category/manage_category/')}}/{{$list->id}}"><button type="button" class="btn btn-primary p-2">Edit</button></a>
                                            @if($list->status==0)
                                            <a href="{{url('admin/category/status/1')}}/{{$list->id}}"><button type="button" class="btn btn-primary p-2">Active</button></a></td>
                                            @elseif($list->status==1)
                                            <a href="{{url('admin/category/status/0')}}/{{$list->id}}"><button type="button" class="btn btn-primary p-2">Deactive</button></a></td>
                                            @endif
                                                
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
@endsection