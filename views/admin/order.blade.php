@extends('admin/layout')
@section('container')
@section('order_select','active')
<h1>Order</h1>
<br><br>

<div class="col-lg-12 mt-4">
    <div class="table-responsive table--no-card m-b-30">
        <table class="table table-borderless table-striped table-earning">
            <thead>
                <tr>
                    <th>Order Id</th>
                    <th>Customer Name</th>
                    <th>Product Name</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $total=0;

            ?>
                @foreach($orders as $list)
               
                <tr>
                    <td><a href="{{url('/admin/order_detail')}}/{{$list->id}}">{{$list->id}}</a></td>
                    <td>{{$list->name}}</td>
                    <td>{{$list->pname}}</td>

                    <td>{{$list->total_amt-$list->coupon_value}}</td>



                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection