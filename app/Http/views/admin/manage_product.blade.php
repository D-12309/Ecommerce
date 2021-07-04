@extends('admin/layout')
@section('container')
@section('product_select','active')
{{session('msg')}}
<?php
if($id>0){
$image_required="";
}else{
$image_required='required';
}
?>
<div class="col-lg-12">
   <h1 class="mb-3">Manage product</h1>
   <a href="{{url('admin/product')}}" ><button type="button" class="btn btn-primary  p-">Back</button></a>
   <form action="{{route('product.manage_product_process')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
      @csrf
      <div class="card mt-4">
         <div class="card-header">Add product</div>
         <div class="card-body">
            <div class="form-group">
               <label for="name" class="control-label mb-1" >Product Name </label>
               <input id="name" name="name" type="text" class="form-control" value="{{$name}}" Required>
            </div>
            @error('name')
            {{$message}}
            @enderror
            <div class="form-group">
               <label for="slug" class="control-label mb-1" >Product Slug</label>
               <input id="slug" name="slug" type="text" value="{{$slug}}" class="form-control cc-name " Required>
            </div>
            @error('slug')
            {{$message}}
            @enderror
            <div class="form-group">
               <label for="image" class="control-label mb-1" >Product image</label>
               <input id="image" name="image" type="file" value="{{$image}}" class="form-control cc-name " {{$image_required}}>
               @if($image!='')
               <img width="100px" height="50px" src="{{asset('storage/media')}}/{{$image}}" alt="">
                        @endif
            </div>
            <!-- @error('image')
               {{$message}}
               @enderror -->
            <div class="form-group">
               <label for="uses" class="control-label mb-1" >Product uses</label>
               <input id="uses" name="uses" type="text" value="{{$uses}}" class="form-control cc-name " Required>
            </div>
            @error('uses')
            {{$message}}
            @enderror
            <div class="row">
               <div class="col-md-4">
               <div class="form-group">
               <label for="lead_time" class="control-label mb-1" >Product Lead Time</label>
               <input id="lead_time" name="lead_time" type="text" value="{{$lead_time}}" class="form-control cc-name " Required>
               </div>
               </div>
               <div class="col-md-4">
               <div class="form-group">
                  <label for="tax" class="control-label mb-1" >Product Tax</label>
                  <input id="tax" name="tax" type="text" value="{{$tax}}" class="form-control cc-name " Required>
               </div>
               </div>
               <div class="col-md-4">
                <div class="form-group">
                  <label for="tax_type" class="control-label mb-1" >Product Tax Type </label>
                  <input id="tax_type" name="tax_type" type="text" value="{{$tax_type}}" class="form-control cc-name " Required>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-3">
               <div class="form-group">
               <label for="is_promo" class="control-label mb-1" >Product Is Promo</label>
               <select name="is_promo" class="form-control cc-name" id="is_promo">
               @if($is_promo=='0')
                  <option value="0">Yes</option>
               <option value="1" selected>No</option>
               @else
               <option value="0" selected>Yes</option>
               <option value="1" >No</option>
               @endif
               </select>
               </div>
               </div>
               <div class="col-md-3">
               <div class="form-group">
               <label for="is_featured" class="control-label mb-1" >Product Is featured</label>
               <select name="is_featured" class="form-control cc-name" id="is_featured">
               @if($is_featured==1)
                  <option value="1" selected>Yes</option>
               <option value="0" >No</option>
               @else
               <option value="1" >Yes</option>
               <option value="0"selected >No</option>
               @endif
               </select>
               </div>
               </div>
               <div class="col-md-3">
               <div class="form-group">
               <label for="is_discounted" class="control-label mb-1" >Product Is discounted</label>
               <select name="is_discounted" class="form-control cc-name" id="is_discounted">
               @if($is_discounted==1)
                  <option value="1" selected>Yes</option>
               <option value="0" >No</option>
               @else
               <option value="1" >Yes</option>
               <option value="0"selected >No</option>
               @endif
               </select>
               </div>
               </div>
               <div class="col-md-3">
               <div class="form-group">
               <label for="id_tranding" class="control-label mb-1" >Product Is Tranding</label>
               <select name="id_tranding" class="form-control cc-name" id="id_tranding">
               @if($id_tranding==1)
                  <option value="1" selected>Yes</option>
               <option value="0" >No</option>
               @else
               <option value="1" >Yes</option>
               <option value="0"selected >No</option>
               @endif
               </select>
               </div>
               </div>

            </div>
            <div class="form-group">
               <label for="desc" class="control-label mb-1" >Product desc</label>
               <textarea name="desc" id="desc" class="form-control cc-name "cols="30" rows="10" Required>{{$desc}}</textarea>
            </div>
            @error('desc')
            {{$message}}
            @enderror
            <div class="form-group">
               <label for="short_desc" class="control-label mb-1" >Product short_desc</label>
               <input id="short_desc" name="short_desc" type="text" value="{{$short_desc}}" class="form-control cc-name " Required>
            </div>
            @error('short_desc')
            {{$message}}
            @enderror
            <div class="form-group">
               <label for="technical_specification" class="control-label mb-1" >Product technical_specification</label>
               <input id="technical_specification" name="technical_specification" type="text" value="{{$technical_specification}}" class="form-control cc-name " Required>
            </div>
            @error('technical_specification')
            {{$message}}
            @enderror
            <div class="form-group">
               <label for="warranty" class="control-label mb-1" >Product warranty</label>
               <input id="warranty" name="warranty" type="text" value="{{$warranty}}" class="form-control cc-name " Required>
            </div>
            @error('warranty')
            {{$message}}
            @enderror
            <div class="row">
               <div class="col-md-4">
                  <div class="form-group">
                     <label for="category_id" class="control-label mb-1" >Product category</label>
                     <select name="category_id" id="category_id" class="form-control cc-name">
                        <option value="">select Category</option>
                        @foreach($category as $list)
                        @if($category_id==$list->id)
                        <option selected value="{{$list->id}}">
                           @else
                        <option value="{{$list->id}}">
                           @endif
                           {{$list->category_name}}
                        </option>
                        @endforeach
                     </select>
                     <!-- <input id="category_id" name="category_id" type="text" value="{{$category_id}}" class="form-control cc-name " Required> -->
                  </div>
                  @error('category_id')
                  {{$message}}
                  @enderror
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label for="model" class="control-label mb-1" >Product model</label>
                     <input id="model" name="model" type="text" value="{{$model}}" class="form-control cc-name " Required>
                  </div>
                  @error('model')
                  {{$message}}
                  @enderror
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label for="brand" class="control-label mb-1" >Product brand</label>
                     <select name="brand" id="brand" class="form-control cc-name">
                        <option value="">select brand</option>
                        @foreach($brands as $list)
                        @if($brand==$list->id)
                        <option selected value="{{$list->id}}">
                           @else
                        <option value="{{$list->id}}">
                           @endif
                           {{$list->name}}
                        </option>
                        @endforeach
                     </select>
                     
                  </div>
                  @error('brand')
                  {{$message}}
                  @enderror
               </div>
            </div>
            <div class="form-group">
               <label for="keywords" class="control-label mb-1" >Product keywords</label>
               <input id="keywords" name="keywords" type="text" value="{{$keywords}}" class="form-control cc-name " Required>
            </div>
            @error('keywords')
            {{$message}}
            @enderror
            <input type="hidden" name="id" value="{{$id}}"/>
         </div>
      </div>
      <h2>Product Attribute</h2>
    
      <div class="col-lg-12" id="product_attr_box">
         @php
         $loop_count_num=1
         @endphp
         @foreach($productattrArr as $key=>$val)
         <?php
         $arr=(array)$val;
         $loop_count_prev= $loop_count_num;
         ?>
         <input id="paid" name="paid[]" type="hidden"  class="form-control cc-name " value="{{$arr['id']}}">
         <div class="card mt-4" id="product_attr_{{$loop_count_num++}}"  >
            <div class="card-body ">
               <div class="form-group">
                  <div class="row">
                     <div class="col-md-4">
                        <label for="size_id" class="control-label mb-1" >Product size</label>
                        <select name="size_id[]" id="size_id" class="form-control cc-name" value="{{$arr['size_id']}}">
                           <option value="">select size</option>
                           @foreach($size as $list)
                         
                           @if($arr['size_id']==$list->id)
                           <option value="{{$list->id}}" selected>
                             
                              @else
                           <option value="{{$list->id}}" >
                           @endif
                           {{$list->size}}
                           </option>
                           @endforeach
                        </select>
                     </div>
                     <div class="col-md-4">
                        <label for="color_id" class="control-label mb-1" >Product color</label>
                        <select name="color_id[]" value="{{$arr['color_id']}}" id="color_id" class="form-control cc-name">
                           <option value="">select color</option>
                           @foreach($color as $list)
                           @if($arr['color_id']==$list->id)
                           <option value="{{$list->id}}" selected>
                            
                              @else
                           <option value="{{$list->id}}" >
                           @endif
                           {{$list->color}}

                           </option>
                           @endforeach
                        </select>
                     </div>
                     <div class="col-md-4">
                        <label for="image_attr" class="control-label mb-1" >Product Image</label>
                        <input id="image_attr" name="image_attr[]" type="file"  class="form-control cc-name " Required>
                        @if($arr['image_attr']!='')
                        <img width="100px" height="50px" src="{{asset('storage/media/'.$arr['image_attr'])}}" alt="">
                        @endif
                     </div>
                     <div class="col-md-4">
                        <label for="sku" class="control-label mb-1" >Product sku</label>
                        <input id="sku" name="sku[]" type="text" value="{{$arr['sku']}}"  class="form-control cc-name " Required>
                     </div>
                     <div class="col-md-4">
                        <label for="qty" class="control-label mb-1" >Product qty</label>
                        <input id="qty" name="qty[]" type="text" value="{{$arr['qty']}} " class="form-control cc-name " Required>
                     </div>
                     <div class="col-md-4">
                        <label for="mrp" class="control-label mb-1" >Product mrp</label>
                        <input id="mrp" name="mrp[]" type="text" value="{{$arr['mrp']}}"  class="form-control cc-name " Required>
                     </div>
                     <div class="col-md-4">
                        <label for="price" class="control-label mb-1" >Product price</label>
                        <input id="price" name="price[]" type="text" value="{{$arr['price']}}"  class="form-control cc-name " Required>
                     </div>
                     @if($loop_count_num==2)
                     <div class="col-md-4">
                        <label for="mrp" class="control-label mb-1" > &nbsp;&nbsp;&nbsp;</label>
                        <button type="button" onclick="add_more()" class="btn btn-success btn-lg mt-3">
                        <i class="fa fa-plus"></i> &nbsp;Add</button>
                     </div>
                     @else
                     <div class="col-md-4">
                        <label for="mrp" class="control-label mb-1" > &nbsp;&nbsp;&nbsp;</label>

                        <a href="{{url('admin/product/product_attr_delete/')}}/{{$arr['id']}}/{{$id}}">
                        <button type="button" class="btn btn-success btn-lg mt-3">
                        <i class="fa fa-minus"></i> &nbsp;Remove</button>
                        </a>
                     </div>
                     @endif
                  </div>
               </div>
            </div>
         </div>
         @endforeach
      </div>
      <h2>Product Images</h2>
      <div class="col-lg-12" >
        
         
         <div class="card mt-4"   >
            <div class="card-body ">
               <div class="form-group">
               @php
                              $loop_count_num=1
                                 @endphp
                                        @foreach($productimagesArr as $key=>$val)
                                  <?php
                                              $iarr=(array)$val;
              
                                             $loop_count_prev= $loop_count_num;
                                                   ?>
                                                   <input id="piid" name="piid[]" type="hidden"  class="form-control cc-name " value="{{$iarr['id']}}">
                  <div class="row" id="product_images_box">
                           
                   
                        <div class="col-md-3 product_images_{{$loop_count_num++}}">
                        <label for="images" class="control-label mb-1" >Product Image</label>
                       
                        <input id="images" name="images[]" type="file"  class="form-control cc-name " Required>
                        @if($iarr['images']!='')
                        <img width="100px" height="50px" src="{{asset('storage/media/'.$iarr['images'])}}" alt="sdfsd">
                        @endif
                        </div>
 

                        @if($loop_count_num==2)
                        <div class="col-md-3">
                        <label for="mrp" class="control-label mb-1" > &nbsp;&nbsp;&nbsp;</label>
                        <button type="button" onclick="add_image_more()" class="btn btn-success btn-lg mt-3">
                        <i class="fa fa-plus"></i> &nbsp;Add</button>
                        </div>
                        @else
                        <div class="col-md-3">
                        <label for="mrp" class="control-label mb-1" > &nbsp;&nbsp;&nbsp;</label>

                        <a href="{{url('admin/product/product_images_delete/')}}/{{$iarr['id']}}/{{$id}}">
                        <button type="button" class="btn btn-success btn-lg mt-3">
                        <i class="fa fa-minus"></i> &nbsp;Remove</button>
                        </a>
                        </div>
                        @endif
                  
                  </div>
                  @endforeach
               </div>
            </div>
         </div>
         
      </div>
</div>
</div>
<div class="mt-5">
<button  id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
Submit
</button>
</div>
</form>
</div>
<script>
    var loop_count=1;
   function add_more(){
       loop_count++;
       var html='    <input id="paid" name="paid[]" type="hidden"  class="form-control cc-name " >  <div class="card  " id="product_attr_'+loop_count+'" > <div class="card-body"><div class="form-group"><div class="row"> ';
       var size_id_html=jQuery('#size_id').html();
       html+=' <div class="col-md-4"> <label for="size_id" class="control-label mb-1" >Product Size</label><select name="size_id[]" id="size_id" class="form-control cc-name">'+size_id_html+'</select></div>';
       var color_id_html=jQuery('#color_id').html();
       html+=' <div class="col-md-4"> <label for="color_id" class="control-label mb-1" >Product color</label><select name="color_id[]" id="color_id" class="form-control cc-name">'+color_id_html+'</select></div>';
       html+='<div class="col-md-4"> <label for="image_attr" class="control-label mb-1" >Product Image</label><input id="image_attr" name="image_attr[]" type="file"  class="form-control cc-name " Required></div>';
       html+='<div class="col-md-4"> <label for="qty" class="control-label mb-1" >Product qty</label><input id="qty" name="qty[]" type="text"  class="form-control cc-name " Required></div>';
    html+='<div class="col-md-4"> <label for="mrp" class="control-label mb-1" >Product mrp</label><input id="mrp" name="mrp[]" type="text"  class="form-control cc-name " Required></div>';
    html+='<div class="col-md-4"> <label for="price" class="control-label mb-1" >Product price</label><input id="price" name="price[]" type="text"  class="form-control cc-name " Required> </div>';

       html+='<div class="col-md-4"> <label for="sku" class="control-label mb-1" >Product sku</label><input id="sku" name="sku[]" type="text"  class="form-control cc-name " Required></div>';
       html+='<div class="col-md-4"><label for="mrp" class="control-label mb-1" > &nbsp;&nbsp;&nbsp;</label><button type="button" onclick="remove('+loop_count+')" class="btn btn-success btn-lg mt-3"> <i class="fa fa-minus"></i> &nbsp;Remove</button></div>';
      
       html+='</div></div></div></div>';
       
       
       jQuery('#product_attr_box').append(html);
   }
   
   function remove(loop_count){
       jQuery('#product_attr_'+loop_count).remove();
   }
     var loop_image_count=1;
   function add_image_more(){
      loop_image_count++
      html='<input id="piid" name="piid[]" type="hidden"  class="form-control cc-name " ><div class="col-md-3 product_images_'+loop_image_count+'"> <label for="images" class="control-label mb-1" >Product Image</label><input id="images" name="images[]" type="file"  class="form-control cc-name " Required></div>';
      html+='<div class="col-md-3 product_images_'+loop_image_count+'" ><label for="images" class="control-label mb-1" > &nbsp;&nbsp;&nbsp;</label><button type="button" onclick="remove_image('+loop_image_count+')" class="btn btn-success btn-lg mt-3"> <i class="fa fa-minus"></i> &nbsp;Remove</button></div>';
      jQuery('#product_images_box').append(html);

   }
   function remove_image(loop_image_count){
       jQuery('.product_images_'+loop_image_count).remove();
   }
</script>
@endsection