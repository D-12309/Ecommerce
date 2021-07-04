@extends('front/layout');
@section('container')
<!-- / footer -->
<section id="checkout">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="checkout-area">
          <form action="" id="orderInfo">
            <div class="row">
              <div class="col-md-8">
                <div class="checkout-left">
                  <div class="panel-group" id="accordion">
                    <!-- Coupon section -->
                    <div class="panel panel-default aa-checkout-coupon">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            Have a Coupon?
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                          <input type="text" placeholder="Coupon Code" name="coupon_code" id="coupon_code" class="aa-coupon-code">
                          <input type="button" value="Apply Coupon" onclick="apply_coupon()" id="apply"  class="aa-browse-btn">
                          @csrf
                          <div id="apply_coupon_msg"></div>
                        </div>
                      </div>
                    </div>
                    <br><br>
                    @if(session()->has('login_email'))

                    @else
                    <a href="" data-toggle="modal" data-target="#login-modal" class="aa-browse-btn">Login</a>
                    @endif
                    <br><br>

                    <!-- Shipping Address -->
                    <div class="panel panel-default aa-checkout-billaddress">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse"  data-parent="#accordion" href="#collapseFour">
                            Shippping Address
                          </a>
                        </h4>
                      </div>
                      <div id="collapseFour" class="panel-collapse collapse">
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder=" Name*" name="name" required value="{{$customer_info['name']}}">
                              </div>

                            </div>
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="email" name="email" placeholder="Email Address*" required value="{{$customer_info['email']}}" >
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="phone" placeholder="Phone*" required value="{{$customer_info['phone']}}">
                              </div>
                            </div>

                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <textarea cols="7" rows="3" name="address" required value="{{$customer_info['address']}}">Address*</textarea>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="city" required  value="{{$customer_info['city']}}" placeholder="City / Town*">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="state" required value="{{$customer_info['state']}}" placeholder="District*">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="aa-checkout-single-bill">
                                <input type="text" name="pincode" required   value="{{$customer_info['zip']}}" placeholder="Postcode / ZIP*">
                              </div>
                            </div>
                          </div>
                        </div>









                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="checkout-right">
                <h4>Order Summary</h4>
                <div class="aa-order-summary-area">
                  <table class="table table-responsive">
                    <thead>
                      <tr>
                        <th>Product</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <?php
                    $total=0;
                    ?>
                    <tbody>
                      @foreach($cart_data as $list)
                      <?php
                      $total=$total+($list->price*$list->qty);
                      ?>
                      <tr>
                        <td>{{$list->name}} <strong> x {{$list->qty}}</strong></td>
                        <td>{{($list->price)*($list->qty)}}</td>
                      </tr>
                      @endforeach
                     
                    </tbody>
                    <tfoot>
           
                      <tr>
                        <th>Total</th>
                        <td>{{$total}}</td>
                      </tr>
                      <tr class="hide display">
                      <th>Final Price <a href="javascript:void(0)" onclick="remove_coupon()">X</a></th>
                      <td id="code"></td>
                      </tr>
                        
                    
                    </tfoot>
                  </table>
                </div>
                <h4>Payment Method</h4>
                <div class="aa-payment-method">
                  <label for="cashdelivery"><input type="radio" id="cod" name="payment_type" value="COD" checked> Cash on Delivery </label>
                  <label for="paypal"><input type="radio" id="paypal" name="payment_type"  value="prepaid" > Via Paypal </label>
                 
                  <input type="submit" value="Place Order" onclick="placeorder()" class="aa-browse-btn">
                </div>
              
                <div id="place_order_msg"></div>
              </div>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
  </div>
</section>
@endsection