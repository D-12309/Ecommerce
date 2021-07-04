@extends('admin/layout')
@section('container')
@section('coupon_select','active')

<h1>Coupon</h1>
<br><br>
{{session('msg')}}
<a href="coupon/manage_coupon" class="ml-auto "><button type="button" class="btn btn-primary p-2">Add Coupon</button></a>


<div class="col-lg-12 mt-4">
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Coupon Title</th>
                                                <th>Coupon Code</th>
                                                <th>Coupon Value</th>

                                                <th>Action</th>

                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $list)
                                        <tr>
                                                <td>{{$list->id}}</td>
                                                <td>{{$list->title}}</td>
                                                <td>{{$list->code}}</td>
                                                <td>{{$list->value}}</td>

                                                <td><a href="{{url('admin/coupon/delete/')}}/{{$list->id}}"><button type="button" class="btn btn-danger p-2">Delete</button></a>

                                            <a href="{{url('admin/coupon/manage_coupon/')}}/{{$list->id}}"><button type="button" class="btn btn-primary p-2">Edit</button></a>
                                            @if($list->status==0)
                                            <a href="{{url('admin/coupon/status/1')}}/{{$list->id}}"><button type="button" class="btn btn-primary p-2">Active</button></a></td>
                                            @elseif($list->status==1)
                                            <a href="{{url('admin/coupon/status/0')}}/{{$list->id}}"><button type="button" class="btn btn-primary p-2">Deactive</button></a></td>
                                            @endif

                                                
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
@endsection