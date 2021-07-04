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
                    <?php
                      if(isset($list[0])){
                    ?>
                 
                      <tr>
                        <th></th>
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($list as $data)
                      <tr id="cartbox_{{$data->attr_id}}">
                        <td><a class="remove" href="javascript:void(0)" onclick="deletecartProduct('{{$data->pid}}','{{$data->size}}','{{$data->color}}','{{$data->attr_id}}','{{$data->price}}')"><fa class="fa fa-close"></fa></a></td>
                        <td><a href="#"><img src="{{asset('storage/media/'.$data->image)}}" alt="img"></a></td>
                        <td><a class="aa-cart-title" href="#">{{$data->name}}</a></td>
                        <td>Rs. {{$data->price}}</td>
                        <td><input class="aa-cart-quantity" id="qty{{$data->attr_id}}" type="number" onchange="updateqty('{{$data->pid}}','{{$data->size}}','{{$data->color}}','{{$data->attr_id}}','{{$data->price}}')" value="{{$data->qty}}"></td>
                        <td id="updateprice_{{$data->attr_id}}">Rs. {{$data->price*$data->qty}}</td>
                      </tr>
                    
                      <tr>
                        @endforeach
                        <td colspan="6" class="aa-cart-view-bottom">
                        
                         
                          
                          <a href="{{url('/checkout')}}" class="aa-cart-view-btn"> Check Out</a>
                        </td>
                      </tr>
                      </tbody>
                      <?php
                      }else{
                          echo '<h3>Cart is Empty</h3>';
                      }
                    ?>
                      
                    
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