@extends('front/layout')
@section('container')

<section id="aa-slider">
    <div class="aa-slider-area">
        <div id="sequence" class="seq">
            <div class="seq-screen">
                <ul class="seq-canvas">
                    <!-- single slide item -->
                    @foreach($banner as $list)

                    <li>
                        <div class="seq-model">
                        <img src="{{asset('storage/media/'.$list->image)}}" alt="img">
                        </div>
                        <div class="seq-title">
                          
                            <a data-seq href="#" class="aa-shop-now-btn aa-secondary-btn">{{$list->btn_txt}}</a>
                        </div>
                    </li>
                    @endforeach
                    <!-- single slide item -->
                  
                </ul>
            </div>
            <!-- slider navigation btn -->
            <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
                <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
                <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
            </fieldset>
        </div>
        
    </div>
</section>
<section id="aa-promo">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="aa-promo-area">
                    <div class="row">
                        <!-- promo left -->

                        <!-- promo right -->
                        <div class="col-md-12 no-padding">
                            <div class="aa-promo-right">
                                @foreach($home_category as $list)

                                <div class="aa-single-promo-right">

                                    <div class="aa-promo-banner">
                                        <img src="{{asset('storage/media/'.$list->image)}}" alt="img">
                                        <div class="aa-prom-content">

                                            <h4><a href="#">{{$list->category_name}}</a></h4>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>
<section id="aa-product">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="aa-product-area">
                        <div class="aa-product-inner">
                            <!-- start prduct navigation -->
                            <ul class="nav nav-tabs aa-products-tab">

                                @foreach($home_category as $list)

                                <li><a href="#cat{{$list->id}}" data-toggle="tab">{{$list->category_name}}</a></li>
                                @endforeach
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                @php
                                @$loop_count=1;
                                @endphp
                                @foreach($home_category as $list)
                                @php
                                @$cat_class="";
                                if($loop_count==1){
                                $cat_class="in active";
                                $loop_count++;
                                }
                                @endphp
                                <div class="tab-pane fade {{$cat_class}} " id="cat{{$list->id}}">
                                    <ul class="aa-product-catg">
                                        @if(isset($home_category_product[$list->id][0]))
                                        @foreach($home_category_product[$list->id] as $list1)
                                        <li>

                                            <figure>

                                                <a class="aa-product-img" href="{{url('product/'.$list1->id)}}"><img style="width: 250px; height:300px" src="{{asset('storage/media/'.$list1->image)}}" alt="polo shirt img"></a>
                                                <a class="aa-add-card-btn" href="javascript:void(0)" onclick="home_to_cart('{{$list1->id}}','{{$home_product_attr[$list1->id][0]->color}}','{{$home_product_attr[$list1->id][0]->size}}')"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                <figcaption>
                                                    <h4 class="aa-product-title"><a href="#">{{$list1->name}}</a></h4>
                                                   
                                                   
                                                    <span class="aa-product-price">Rs. {{$home_product_attr[$list1->id][0]->price}}</span>
                                                    <span class="aa-product-price"><del>Rs. {{$home_product_attr[$list1->id][0]->mrp}}</del></span>
                                               
                                                </figcaption>
                                            </figure>

                                            <!-- product badge -->
                                        </li>

                                        @endforeach
                                        @else
                                        <h2>No Record Found</h2>
                                        @endif
















                                </div>
                                @endforeach

                            </div>
                            <!-- quick view modal -->
                            <!-- / quick view modal -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="aa-popular-category">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="aa-popular-category-area">
                        <!-- <!-- start prduct navigation -->
                        <ul class="nav nav-tabs aa-products-tab">
                            <li class="active"><a href="#featured" data-toggle="tab">Featured</a></li>
                            <li><a href="#discounted" data-toggle="tab">DISCOUNTED</a></li>
                            <li><a href="#trading" data-toggle="tab">TRADIND</a></li>
                        </ul>
                        <!-- <!-- Tab panes  -->
                        <div class="tab-content">
                            <!-- Start men popular category -->
                            <div class="tab-pane fade in active" id="featured">
                                <ul class="aa-product-catg aa-featured-slider">
                                    <!-- start single product item -->
                                    @if(isset($home_category_feature[$list->id][0]))
                                        @foreach($home_category_feature[$list->id] as $list1)
                                        <li>

                                            <figure>

                                                <a class="aa-product-img" href="{{url('product/'.$list1->id)}}"><img style="width: 250px; height:300px" src="{{asset('storage/media/'.$list1->image)}}" alt="polo shirt img"></a>
                                                <a class="aa-add-card-btn" href="{{url('product/'.$list1->id)}}"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                <figcaption>
                                                    <h4 class="aa-product-title"><a href="#">{{$list1->name}}</a></h4>
                                                    @foreach( $home_product_attr[$list1->id] as $list2)
                                                    <span class="aa-product-price">Rs. {{$list2->price}}</span>
                                                    <span class="aa-product-price"><del>Rs. {{$list2->mrp}}</del></span>
                                                    @endforeach
                                                </figcaption>
                                            </figure>

                                            <!-- product badge -->
                                        </li>

                                        @endforeach
                                        @else
                                        <h2>No Record Found</h2>
                                        @endif
                                    <!-- start single product item -->

                                </ul>

                            </div>


                            <div class="tab-pane fade" id="discounted">
                                <ul class="aa-product-catg aa-discounted-slider">



                                @if(isset($home_category_discount[$list->id][0]))
                                        @foreach($home_category_discount[$list->id] as $list1)
                                        <li>

                                            <figure>

                                                <a class="aa-product-img" href="{{url('product/'.$list1->id)}}"><img style="width: 250px; height:300px" src="{{asset('storage/media/'.$list1->image)}}" alt="polo shirt img"></a>
                                                <a class="aa-add-card-btn" href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                <figcaption>
                                                    <h4 class="aa-product-title"><a href="{{url('product/'.$list1->id)}}">{{$list1->name}}</a></h4>
                                                    @foreach( $home_product_attr[$list1->id] as $list2)
                                                    <span class="aa-product-price">Rs. {{$list2->price}}</span>
                                                    <span class="aa-product-price"><del>Rs. {{$list2->mrp}}</del></span>
                                                    @endforeach
                                                </figcaption>
                                            </figure>

                                            <!-- product badge -->
                                        </li>

                                        @endforeach
                                        @else
                                        <h2>No Record Found</h2>
                                        @endif



                                    <!-- start single product item -->

                                </ul>

                            </div>
                            <!-- start discounted product category -->
                            <div class="tab-pane fade" id="trading">
                                <ul class="aa-product-catg aa-trading-slider">
                                    <!-- start single product item -->
                                    @if(isset($home_category_trading[$list->id][0]))
                                        @foreach($home_category_trading[$list->id] as $list1)
                                        <li>

                                            <figure>

                                                <a class="aa-product-img" href="{{url('product/'.$list1->id)}}"><img style="width: 250px; height:300px" src="{{asset('storage/media/'.$list1->image)}}" alt="polo shirt img"></a>
                                                <a class="aa-add-card-btn" href="{{url('product/'.$list1->id)}}"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                <figcaption>
                                                    <h4 class="aa-product-title"><a href="#">{{$list1->name}}</a></h4>
                                                    @foreach( $home_product_attr[$list1->id] as $list2)
                                                    <span class="aa-product-price">Rs. {{$list2->price}}</span>
                                                    <span class="aa-product-price"><del>Rs. {{$list2->mrp}}</del></span>
                                                    @endforeach
                                                </figcaption>
                                            </figure>

                                            <!-- product badge -->
                                        </li>

                                        @endforeach
                                        @else
                                        <h2>No Record Found</h2>
                                        @endif
                                    <!-- start single product item -->

                                </ul>

                            </div>
                            <!-- / latest product category -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->


<!-- Client Brand -->
<section id="aa-client-brand">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="aa-client-brand-area">
                    <ul class="aa-client-brand-slider">
                        @foreach($brand as $list3)
                        <li><a href="#"><img src="{{asset('storage/media/'.$list3->image)}}" style="width: 135px; height:33px" alt="java img"></a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Client Brand -->

<!-- Subscribe section -->
<section id="aa-subscribe">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="aa-subscribe-area">
                    <h3>Subscribe our newsletter </h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, velit!</p>
                    <form action="" class="aa-subscribe-form">
                        <input type="email" name="" id="" placeholder="Enter your Email">
                        <input type="submit" value="Subscribe">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Subscribe section -->
<input type="hidden" id="pqty" value="1">
<form action="" id="frmaddtocart">
  @csrf
  <input type="hidden" id="size_id" name="size_id">
  <input type="hidden" id="color_id" name="color_id">
  <input type="hidden" id="qty" name="qty">
  <input type="hidden" id="product_id" name="product_id">

</form>
@endsection