@extends('front/layout');
@section('container')
<section id="aa-product-category">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
        <div class="aa-product-catg-content">
          <div class="aa-product-catg-head">
            <div class="aa-product-catg-head-left">
              <form action="" class="aa-sort-form">
                <label for="">Sort by</label>
                <select name=""  onchange="sort()" id="sort_by">
                  <option value="" selected="Default">Default</option>
                  <option value="name">Name</option>
                  <option value="price_asc">Price-Asc</option>
                  <option value="price_desc">Price-desc</option>

                  <option value="date">Date</option>
                </select>
              </form>
              <form action="" class="aa-show-form">
                <label for="">Show</label>
                <select name="">
                  <option value="1" selected="12">12</option>
                  <option value="2">24</option>
                  <option value="3">36</option>
                </select>
              </form>
            </div>
            <div class="aa-product-catg-head-right">
              <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
              <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
            </div>
          </div>
          <div class="aa-product-catg-body">
            <ul class="aa-product-catg">
              <!-- start single product item -->

              <!-- start single product item -->
              @if(isset($product[0]))
              @foreach($product as $list1)
       
         
              <li>

                <figure>

                  <a class="aa-product-img" href="{{url('product/'.$list1->id)}}"><img style="width: 250px; height:300px" src="{{asset('storage/media/'.$list1->image)}}" alt="polo shirt img"></a>
                  <a class="aa-add-card-btn" href="javascript:void(0)" onclick="home_to_cart('{{$list1->id}}','{{$home_attr[$list1->id][0]->color}}','{{$home_attr[$list1->id][0]->size}}')"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                  <figcaption>
                    <h4 class="aa-product-title"><a href="{{url('product/'.$list1->id)}}">{{$list1->name}}</a></h4>
                
                    <span class="aa-product-price">Rs. {{$home_attr[$list1->id][0]->price}}</span>
                    <span class="aa-product-price"><del>Rs. {{$home_attr[$list1->id][0]->mrp}}</del></span>
                  
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
            <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <div class="row">
                      <!-- Modal view slider -->
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="aa-product-view-slider">
                          <div class="simpleLens-gallery-container" id="demo-1">
                            <div class="simpleLens-container">
                              <div class="simpleLens-big-image-container">
                                <a class="simpleLens-lens-image" data-lens-image="img/view-slider/large/polo-shirt-1.png">
                                  <img src="img/view-slider/medium/polo-shirt-1.png" class="simpleLens-big-image">
                                </a>
                              </div>
                            </div>
                            <div class="simpleLens-thumbnails-container">
                              <a href="#" class="simpleLens-thumbnail-wrapper" data-lens-image="img/view-slider/large/polo-shirt-1.png" data-big-image="img/view-slider/medium/polo-shirt-1.png">
                                <img src="img/view-slider/thumbnail/polo-shirt-1.png">
                              </a>
                              <a href="#" class="simpleLens-thumbnail-wrapper" data-lens-image="img/view-slider/large/polo-shirt-3.png" data-big-image="img/view-slider/medium/polo-shirt-3.png">
                                <img src="img/view-slider/thumbnail/polo-shirt-3.png">
                              </a>

                              <a href="#" class="simpleLens-thumbnail-wrapper" data-lens-image="img/view-slider/large/polo-shirt-4.png" data-big-image="img/view-slider/medium/polo-shirt-4.png">
                                <img src="img/view-slider/thumbnail/polo-shirt-4.png">
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Modal view content -->
                      
                    </div>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div>
            <!-- / quick view modal -->
          </div>
          <!-- <div class="aa-product-catg-pagination">
              <nav>
                <ul class="pagination">
                  <li>
                    <a href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  <li><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#">5</a></li>
                  <li>
                    <a href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div> -->
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
        <aside class="aa-sidebar">
          <!-- single sidebar -->
          <div class="aa-sidebar-widget">
            <h3>Category</h3>
            <ul class="aa-catg-nav">
            @foreach($category_left as $list)
            @if($list->category_slug==$slug)
              <li ><a style="color: red;" href="/category/{{$list->category_slug}}">{{$list->category_name}}</a></li>
              @else<li ><a href="/category/{{$list->category_slug}}">{{$list->category_name}}</a></li>
              @endif
      @endforeach
            </ul>
          </div>
          <!-- single sidebar -->
       
          <!-- single sidebar -->
          <div class="aa-sidebar-widget">
            <h3>Shop By Price</h3>
            <!-- price range -->
            <div class="aa-sidebar-price-range">
              <form action="">
                <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                </div>
                <span id="skip-value-lower" class="example-val" >30.00</span>
                <span id="skip-value-upper" class="example-val">100.00</span>
                <button class="aa-filter-btn" type="button"  onclick="price_filter()">Filter</button>
              </form>
            </div>

          </div>
          <!-- single sidebar -->
         
          <!-- single sidebar -->

        </aside>
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
  <input type="hidden" id="sort_val" name="sort" >


  <input type="hidden" id="price_lower_filter" name="price_lower_filter" value="{{$price_lower_filter}}">
  <input type="hidden" id="price_upper_filter" name="price_upper_filter" value="{{$price_upper_filter}}">

</form>
@endsection