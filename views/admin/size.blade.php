@extends('admin/layout')
@section('container')
@section('size_select','active')
<h1>Category</h1>
<br><br>
{{session('msg')}}
<a href="size/manage_size" class="ml-auto "><button type="button" class="btn btn-primary p-2">Size</button></a>


<div class="col-lg-12 mt-4">
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Size</th>
                
                                                <th>Action</th>

                                       
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $list)
                                        <tr>
                                                <td>{{$list->id}}</td>
                                                <td>{{$list->size}}</td>
                                               
                                                <td><a href="{{url('admin/size/delete/')}}/{{$list->id}}"><button type="button" class="btn btn-danger p-2">Delete</button></a>

                                            <a href="{{url('admin/size/manage_size/')}}/{{$list->id}}"><button type="button" class="btn btn-primary p-2">Edit</button></a>
                                            @if($list->status==0)
                                            <a href="{{url('admin/size/status/1')}}/{{$list->id}}"><button type="button" class="btn btn-primary p-2">Active</button></a></td>
                                            @elseif($list->status==1)
                                            <a href="{{url('admin/size/status/0')}}/{{$list->id}}"><button type="button" class="btn btn-primary p-2">Deactive</button></a></td>
                                            @endif
                                                
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
@endsection