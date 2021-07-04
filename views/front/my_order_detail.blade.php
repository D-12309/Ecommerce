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
                    $total=0;
                    ?>
                      @foreach($order_detail as $list)
                      <?php
                      $total=$total+($list->total_amt-$list->coupon_value);
                      ?>
                      <td>{{$list->name}}</td>
                      <td>{{$list->coupon_value}}</td>
                      <td>{{$list->coupon_code}}</td>
                      <td>{{$list->qty}}</td>
                      <td>{{$list->total_amt}}</td>
                    


                      <td>{{$list->txt_id}}</td>
                      <td>{{$total}}</td>

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