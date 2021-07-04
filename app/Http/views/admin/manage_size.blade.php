@extends('admin/layout')
@section('container')
@section('size_select','active')


<div class="col-lg-12">
<h1 class="mb-3">Manage Size</h1>
<a href="{{url('admin/size')}}" ><button type="button" class="btn btn-primary  p-">Back</button></a>
                                <div class="card mt-4">
                                    <div class="card-header">Manage Size</div>
                                    <div class="card-body">
                                       
                                       
                                        <form action="{{route('size.manage_size_process')}}" method="post" novalidate="novalidate">
                                        @csrf
                                            <div class="form-group">
                                                <label for="size" class="control-label mb-1" >Size Name </label>
                                                <input id="size" name="size" type="text" class="form-control" value="{{$size}}" Required>
                                            </div>
                                            @error('size')
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