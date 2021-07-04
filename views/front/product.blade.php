@extends('front/layout');
@section('container')

<section id="aa-product-details">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="aa-product-details-area">
          <div class="aa-product-details-content">
            <div class="row">
              <!-- Modal view slider -->
              <div class="col-md-5 col-sm-5 col-xs-12">
                <div class="aa-product-view-slider">
                  <div id="demo-1" class="simpleLens-gallery-container">
                    <div class="simpleLens-container">
                      <div class="simpleLens-big-image-container"><a data-lens-image="{{asset('storage/media/'.$product[0]->image)}}" class="simpleLens-lens-image"><img src="{{asset('storage/media/'.$product[0]->image)}}" class="simpleLens-big-image"></a></div>
                    </div>
                    <div class="simpleLens-thumbnails-container">
                      @if($image_attr[$product[0]->id][0])
                      @foreach($image_attr[$product[0]->id] as $list)
                      <a data-big-image="{{asset('storage/media/'.$list->images)}}" data-lens-image="{{asset('storage/media/'.$list->images)}}" class="simpleLens-thumbnail-wrapper" href="#">
                        <img src="{{asset('storage/media/'.$list->images)}}" class="simpleLens-big-image" width="50px">
                      </a>
                      @endforeach
                      @endif


                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal view content -->
              <div class="col-md-7 col-sm-7 col-xs-12">
                <div class="aa-product-view-content">
                  <h3>{{$product[0]->name}}</h3>
                  <div class="aa-price-block">
                    <span class="aa-product-view-price">Rs. {{$home_product_attr[$product[0]->id][0]->price}}</span>
                    <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                  </div>
                  <p>{{$product[0]->desc}}</p>
                  <h4>Size</h4>
                  @if($home_product_attr[$product[0]->id][0]->size)

                  <div class="aa-prod-view-size">
                    @foreach($home_product_attr[$product[0]->id] as $list)


                    <a href="javascript:void(0)" onclick="show_color('{{$list->size}}')" class="size_link" id="{{$list->size}}">{{$list->size}}</a>


                    @endforeach
                  </div>

                  @endif

                  <h4>Color</h4>
                  @if($home_product_attr[$product[0]->id][0]->color)
                  <div class="aa-color-tag">
                    @foreach($home_product_attr[$product[0]->id] as $list)

                    <a href="javascript:void(0)" class="aa-color-{{$list->color}} hide_color {{$list->size}}" id="hide_color" onclick=change_image("{{asset('storage/media/'.$list->image_attr)}}","{{$list->color}}")></a>
                    @endforeach
                  </div>
                  @endif
                  <div class="aa-prod-quantity">
                    <form action="">
                      <select id="pqty" name="pqty">
                        @for($i=1;$i<11;$i++) <option value="{{$i}}">{{$i}}</option>
                          @endfor

                      </select>
                    </form>
                    <p class="aa-prod-category">
                      Category: <a href="#">Polo T-Shirt</a>
                    </p>
                  </div>
                  <div class="aa-prod-view-bottom">
                    <a class="aa-add-to-cart-btn" href="javascript:void(0)" onclick="add_to_cart('{{$product[0]->id}}')">Add To Cart</a>

                  </div>
                  <div class="cart_msg"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="aa-product-details-bottom">
            <ul class="nav nav-tabs" id="myTab2">
              <li><a href="#description" data-toggle="tab">Description</a></li>
              <li><a href="#review" data-toggle="tab">Reviews</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div class="tab-pane fade in active" id="description">
                <p>{{$product[0]->desc}}</p>
              </div>
              <div class="tab-pane fade " id="review">
                <div class="aa-product-review-area">
                
                  <ul class="aa-review-nav">
                 @foreach($show_rating as $list)
                    <li>
                      <div class="media">
                      
                        <div class="media-body">

                          <h4 class="media-heading"><strong>{{$list->name}}</strong> - <span>{{$list->added_on}}</span></h4>
                         <p>Rating : {{$list->rating}} </p>
                          <p>{{$list->review}}</p>
                        </div>
                      </div>
                    </li>
                    @endforeach
                  </ul>
                  <form id="frmreviewrating" class="aa-review-form">
                    <h4>Add a review</h4>
                    <div class="aa-your-rating">
                      <p>Your Rating</p>
                      <select name="rating" id="">
                        <option value="">select Rating</option>
                        <option value="good">Good</option>
                        <option value="verygood">Very Good</option>
                        <option value="fantastic">Fantastic</option>

                      </select>
                    </div>
                    <!-- review form -->

                    <div class="form-group">
                      <label for="message">Your Review</label>
                      <textarea class="form-control" name="review" rows="3" id="message"></textarea>
                    </div>
                    <input type="hidden" name="product_id" value="{{$product[0]->id}}">

                    @csrf
                    <button type="submit" class="btn btn-default aa-review-submit">Submit</button>

                  </form>
                  <div id="rating_msg"></div>
                </div>
              </div>
            </div>
          </div>
          <!-- Related product -->
          <div class="aa-product-related-item">
            <h3>Related Products</h3>
            <ul class="aa-product-catg aa-related-item-slider">
              <!-- start single product item -->
              @if(isset($related_product[0]))
              @foreach($related_product_attr[$related_product[0]->id] as $list1)
              <li>

                <figure>


                  <a class="aa-product-img" href="{{url('product/'.$related_product[0]->id)}}"><img style="width: 250px; height:300px" src="{{asset('storage/media/'.$related_product[0]->image)}}" alt="polo shirt img"></a>
                  <a class="aa-add-card-btn" href="{{url('product/'.$related_product[0]->id)}}"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                  <figcaption>
                    <h4 class="aa-product-title"><a href="#">{{$related_product[0]->name}}</a></h4>

                    <span class="aa-product-price">Rs. {{$related_product_attr[$related_product[0]->id][0]->price}}</span>
                    <span class="aa-product-price"><del>Rs. {{$related_product_attr[$related_product[0]->id][0]->mrp}}</del></span>


                  </figcaption>
                </figure>

                <!-- product badge -->
              </li>

              @endforeach
              @else
              <h2>No Record Found</h2>
              @endif

            </ul>
            <!-- quick view modal -->

            <!-- / quick view modal -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<form action="" id="frmaddtocart">
  @csrf
  <input type="hidden" id="size_id" name="size_id">
  <input type="hidden" id="color_id" name="color_id">
  <input type="hidden" id="qty" name="qty">
  <input type="hidden" id="product_id" name="product_id">

</form>
@endsection