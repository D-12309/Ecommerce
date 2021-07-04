@extends('front/layout');
@section('container')
<section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="">
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                 
                 
                      <tr>
                        <th>Id</th>
                        <th>Order Status</th>
                        <th>Payment Type</th>
                        <th>Payment Status</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $list)
                    <tr>
                    <td>    <a href="{{url('/my_order_detail')}}/{{$list->id}}">{{$list->id}}</a></td>
                    <td>{{$list->order_status}}</td>
                    <td>{{$list->payment_type}}</td>
                    <td>{{$list->payment_status}}</td>
                    <td>{{$list->total_amt-$list->coupon_value}}</td>

             
                    </tr>
                    @endforeach
                
                        <!-- <td colspan="6" class="aa-cart-view-bottom">
                        
                         
                   
                        </td> -->
                      </tr>
                      </tbody>
                   
                      
                    
                  </table>
                </div>
             </form>
             <!-- Cart Total view -->
            
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <input type="hidden" id="pqty" value="1">
 <form action="" id="frmaddtocart">
  @csrf
  <input type="hidden" id="size_id" name="size_id">
  <input type="hidden" id="color_id" name="color_id">
  <input type="hidden" id="qty" name="qty">
  <input type="hidden" id="product_id" name="product_id">

</form>
@endsection