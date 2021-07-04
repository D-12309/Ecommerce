@extends('admin/layout')
@section('container')
@section('coupon_select','active')

<div class="col-lg-12">
<h1 class="mb-3">Manage Coupon</h1>
<a href="{{url('admin/coupon')}}" ><button type="button" class="btn btn-primary  p-">Back</button></a>
                                <div class="card mt-4">
                                    <div class="card-header">Manage Coupon</div>
                                    <div class="card-body">
                                       
                                       
                                        <form action="{{route('coupon.manage_coupon_process')}}" method="post" novalidate="novalidate">
                                        @csrf
                                            <div class="form-group">
                                                <label for="title" class="control-label mb-1" >Coupon Title </label>
                                                <input id="title" name="title" type="text" class="form-control" value="{{$title}}" Required>
                                            </div>
                                            @error('title')
                                            {{$message}}
                                            @enderror
                                            <div class="form-group">
                                                <label for="code" class="control-label mb-1" >Coupon Code</label>
                                                <input id="code" name="code" type="text" value="{{$code}}" class="form-control cc-name " Required>
                                             
                                            </div>
                                            @error('code')
                                            {{$message}}
                                            @enderror
                                            <div class="form-group">
                                                <label for="value" class="control-label mb-1" >Coupon Value</label>
                                                <input id="value" name="value" type="text" value="{{$value}}" class="form-control cc-name " Required>
                                             
                                            </div>
                                            @error('value')
                                            {{$message}}
                                            @enderror
                                            <div class="row">
                                            <div class="col-md-4">
                                            <div class="form-group">
               <label for="type" class="control-label mb-1" >Type</label>
               <select name="type" class="form-control cc-name" id="is_promo">
               @if($type=='value')
                  <option value="value" selected>Value</option>
               <option value="per" >Per</option>
               @else
               <option value="value" >value</option>
               <option value="per" selected >Per</option>
               @endif
               </select>
               </div>
                                            </div>
                                            <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="min_order_amt" class="control-label mb-1"> min_order_amt</label>
                                                <input id="min_order_amt" name="min_order_amt" type="text" value="{{$min_order_amt}}" class="form-control cc-name " Required>
                                             
                                            </div>
                                            </div>
                                            <div class="col-md-4">
                                            <div class="form-group">
               <label for="is_one_time" class="control-label mb-1" >is_one_time</label>
               <select name="is_one_time" class="form-control cc-name" id="is_one_time">
               @if($is_one_time=='0')
                  <option value="0" selected>Yes</option>
               <option value="1" >No</option>
               @else
               <option value="0" >Yes</option>
               <option value="1" selected >No</option>
               @endif
               </select>
               </div>
                                            </div>

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