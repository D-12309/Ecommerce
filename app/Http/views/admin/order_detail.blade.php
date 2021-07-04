@extends('admin/layout')
@section('container')
@section('order_select','active')
<h1>Order Details</h1>
<br><br>

<div class="col-lg-12 mt-4">
  <a href="{{url('admin/order')}}"><button type="button" class="btn btn-primary  p-">Back</button></a>
  <div class="table-responsive table--no-card m-b-30">

    <table class="table table-borderless table-striped table-earning">

      <thead>
        <div class="row">
          <div class="col-md-6">
            <b> Transcation Id:</b>{{$order_detail[0]->txt_id}}<br>
            <b> Order Status:</b>{{$order_detail[0]->order_status}}<br>
            <b>Payment Status:</b>{{$order_detail[0]->payment_status}}
          </div>
          <div class="col-md-6">
          <b>Payment Status</b>
            <select name="" id="payment_status" class="form-control cc-name" onchange="update_payment_status('{{$order_detail[0]->id}}')">

              @foreach($payment_status as $list)
              <?php
              if($list==$order_detail[0]->payment_status){

                ?>
                 <option value="{{$list}}" selected >{{$list}} </option>
                 <?php
              }
              
                else{
                  ?>
                   <option value="{{$list}}" >{{$list}}</option>
                  <?php
                }
              
              ?>
             
              @endforeach
            </select>

          </div>
        </div>
        <tr>
          <th>Name</th>
          <th>coupon value</th>
          <th>coupon code</th>
          <th>qty</th>
          <th>Total</th>
          <th>Transcation Id</th>
          <th>Final Total </th>
        </tr>
      </thead>
      <tbody>
        <?php
        $total = 0;
        ?>
        @foreach($order_detail as $list)
        <?php
        $total = $total + ($list->total_amt - $list->coupon_value);
        ?>
        <td>{{$list->name}}</td>
        <td>{{$list->coupon_value}}</td>
        <td>{{$list->coupon_code}}</td>
        <td>{{$list->qty}}</td>
        <td>{{$list->total_amt}}</td>



        <td>{{$list->txt_id}}</td>
        <td>{{$total}}</td>

        @endforeach

      </tbody>
    </table>
  </div>
</div>
@endsection