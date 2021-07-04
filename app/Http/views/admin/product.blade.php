@extends('admin/layout')
@section('container')
@section('product_select','active')
<h1>Product</h1>
<br><br>
{{session('msg')}}
<a href="product/manage_product" class="ml-auto "><button type="button" class="btn btn-primary p-2">Add Product</button></a>

<div class="col-lg-12 mt-4">
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>product Name</th>
                                                <th>product Slug</th>
                                                <th>Action</th>
                                                <th>Image</th>


                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $list)
                                        <tr>
                                                <td>{{$list->id}}</td>
                                                <td>{{$list->name}}</td>
                                                <td>{{$list->slug}}</td>
                                                <td><a href="{{url('admin/product/delete/')}}/{{$list->id}}/"><button type="button" class="btn btn-danger p-2">Delete</button></a>

                                            <a href="{{url('admin/product/manage_product/')}}/{{$list->id}}"><button type="button" class="btn btn-primary p-2">Edit</button></a>
                                            @if($list->status==0)
                                            <a href="{{url('admin/product/status/1')}}/{{$list->id}}"><button type="button" class="btn btn-primary p-2">Active</button></a></td>
                                            @elseif($list->status==1)
                                            <a href="{{url('admin/product/status/0')}}/{{$list->id}}"><button type="button" class="btn btn-primary p-2">Deactive</button></a></td>
                                            
                                            @endif
                                                <td><img width="100px" height="50px" src="{{asset('storage/media/'.$list->image)}}" alt=""></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
@endsection