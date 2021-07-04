@extends('admin/layout')
@section('container')
@section('customer_select','active')
<h1>customer</h1>
<br><br>
{{session('msg')}}



<div class="col-lg-12 mt-4">
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>email</th>
                                                <th>city</th>
                                                <th>Action</th>

                                       
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $list)
                                        <tr>
                                                <td>{{$list->id}}</td>
                                                <td>{{$list->name}}</td>
                                                <td>{{$list->email}}</td>
                                                <td>{{$list->city}}</td>


                                               
                                                <td>

                                            <a href="{{url('admin/customer/customer_show/')}}/{{$list->id}}"><button type="button" class="btn btn-primary p-2">View</button></a>
                                            @if($list->status==0)
                                            <a href="{{url('admin/customer/status/1')}}/{{$list->id}}"><button type="button" class="btn btn-primary p-2">Active</button></a></td>
                                            @elseif($list->status==1)
                                            <a href="{{url('admin/customer/status/0')}}/{{$list->id}}"><button type="button" class="btn btn-primary p-2">Deactive</button></a></td>
                                            @endif
                                                
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
@endsection