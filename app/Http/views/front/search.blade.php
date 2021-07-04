@extends('front/layout');
@section('container')

<div class="col-lg-10 col-md-12 col-sm-8 ">
        <div class="aa-product-catg-content ">
         
          <div class="aa-product-catg-body ">
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

<input type="hidden" id="pqty" value="1">
<form action="" id="frmaddtocart">
  @csrf
  <input type="hidden" id="size_id" name="size_id">
  <input type="hidden" id="color_id" name="color_id">
  <input type="hidden" id="qty" name="qty">
  <input type="hidden" id="product_id" name="product_id">


</form>
@endsection