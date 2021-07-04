@extends('admin/layout')
@section('container')
@section('color_select','active')


<div class="col-lg-12">
<h1 class="mb-3">Manage Color</h1>
<a href="{{url('admin/color')}}" ><button type="button" class="btn btn-primary  p-">Back</button></a>
                                <div class="card mt-4">
                                    <div class="card-header">Manage Color</div>
                                    <div class="card-body">
                                       
                                       
                                        <form action="{{route('color.manage_color_process')}}" method="post" novalidate="novalidate">
                                        @csrf
                                            <div class="form-group">
                                                <label for="color" class="control-label mb-1" >Color Name </label>
                                                <input id="color" name="color" type="text" class="form-control" value="{{$color}}" Required>
                                            </div>
                                            @error('color')
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