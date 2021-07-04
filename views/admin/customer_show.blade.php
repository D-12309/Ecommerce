@extends('admin/layout')
@section('container')
@section('customer_select','active')
<h1>customer</h1>
<br><br>
{{session('msg')}}



<div class="col-lg-12 mt-4">
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-earning">
                                   
                                        <tbody>
                                        
                                      
                                        <tr>
                                        <th>Name</th>
                                              <td>{{$cutomerList['name']}}</td>
                                        </tr>
                                        <tr>
                                        <th>Email</th>
                                              <td>{{$cutomerList['name']}}</td>
                                        </tr>  <tr>
                                        <th>Address</th>
                                              <td>{{$cutomerList['address']}}</td>
                                        </tr>  <tr>
                                        <th>City</th>
                                              <td>{{$cutomerList['city']}}</td>
                                        </tr>  <tr>
                                        <th>State</th>
                                              <td>{{$cutomerList['state']}}</td>
                                        </tr>
                                        
                                      
                                        </tbody>
                                    </table>
                                </div>
                            </div>
@endsection