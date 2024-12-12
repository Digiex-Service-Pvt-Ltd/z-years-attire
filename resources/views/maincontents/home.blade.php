@extends('../layouts.home_layout')

@section('maincontent')

<!-- include banner -->
@include('common.banner')
<!----------------------------shop----------------------------->
<section class="mt-30">
  <div class="container">
      <div class="row">
          <div class="col-lg-6 mt-3">
              <div class="shopleft">
                  <div class="shopleftimg" style="background-image: url({{ asset('img/banner-1.jpg') }});">
                      <h5>NEW IN</h5>
                      <h2>WOMEN'S</h2>
                     <a href="{{ url('shop/women-category') }}"><button type="button" class="btn btn-outline-light px-4">SHOP NOW</button></a>
                  </div>
              </div>
          </div>
          <div class="col-lg-6 mt-3">
              <div class="shopleft">
                  <div class="shopleftimg" style="background-image: url({{ asset('img/banner-2.jpg') }});">
                      <h5>NEW IN</h5>
                      <h2>MEN'S</h2>
                     <a href="{{ url('shop/mens-category') }}"><button type="button" class="btn btn-outline-light px-4">SHOP NOW</button></a>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
<!----------------------------shopend----------------------------->

<!------------------------------category---------------------------------->
@if(!empty($featured_categories))
<section class="mt-60">
<div class="container">
    <div class="categoriestextcenter">
        <h2>Shop By Category</h2>
    </div>
    <div class="row mt-30">
        <div class="col-lg-12">
            <div class="categoriesbox">
                <div class="owl-carousel owl-theme carousel-with-shadow categories">
                @foreach($featured_categories as $f_category)
                    @php $c_image_path = ($f_category->image!="") ? asset(config('constants.CATEGORY_IMAGE_PATH').$f_category->image) : asset('img/boxed-bg.jpg') @endphp    
                    <div class="item">
                        <div class="categoriesboxmain categoriesboxmain1" style="background-image: url({{ $c_image_path }});">
                            <div class="categoriesboxmainshop">
                                <h4>{{ $f_category->category_name }}</h4>
                                <a type="button" href="{{ url('shop/'.$f_category->slug) }}" class="btn btn-outline-light">Expolre Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>



</section>
@endif
<!------------------------------categoryend---------------------------------->

<!--------------------------------payment----------------------------------------->
<section class="mt-60 paymentbox">
  <div class="container">
      <div class="row">
          <div class="col-lg-3 mt-3">
              <div class="paymentdelivery">
                  <div class="paymentdeliveryicon">
                      <i class="fa-solid fa-truck"></i>
                  </div>
                  <div class="paymentdeliverytext">
                      <h5>Payment & Delivery</h5>
                      <p>Free shipping for orders over 50</p>
                  </div>
               
              </div>
          </div>
          <div class="col-lg-3 mt-3">
              <div class="paymentdelivery">
                  <div class="paymentdeliveryicon">
                      <i class="fa-solid fa-rotate-left"></i>
                  </div>
                  <div class="paymentdeliverytext">
                      <h5>Return & Refund</h5>
                      <p>Free 100% money back guarantee</p>
                  </div>
  
              </div>
          </div>
          <div class="col-lg-3 mt-3">
              <div class="paymentdelivery">
                  <div class="paymentdeliveryicon">
                      <i class="fa-solid fa-unlock"></i>
                  </div>
                  <div class="paymentdeliverytext">
                      <h5>Secure Payment</h5>
                      <p>100% secure payment</p>
                  </div>
               
              </div>
          </div>
          <div class="col-lg-3 mt-3">
              <div class="paymentdelivery">
                  <div class="paymentdeliveryicon">
                      <i class="fa-solid fa-headphones"></i>
                  </div>
                  <div class="paymentdeliverytext">
                      <h5>Quality Support</h5>
                      <p>Alway online feedback 24/7</p>
                  </div>
              
              </div>
          </div>
      </div>
  </div>
</section>

<!--------------------------------paymentend----------------------------------------->

<!---------------------------------newarrival--------------------------------------->
<section class="mt-60">

    <div class="container">
        <div class="categoriestextcenter">
          <h2>New Arrivals</h2>
        </div>
        <div class="row">
               
                    @if($latest_products->isNotEmpty() )
                        @foreach($latest_products as $varient_product)
                                @php $p_image_path = ($varient_product->image_name!="") ? asset(config('constants.PRODUCT_IMAGE_PATH').$varient_product->image_name) : asset('img/boxed-bg.jpg')
                                @endphp
                                <div class="col-lg-3 mt-3">
                                    <div class="newarraivalbox">
                                        <div class="newarraivalboximg" style="background-image: url({{ asset($p_image_path)}});">
                                            <div class="newarraivalboximg1">
                                                <button type="button" class="btn btn-outline-light">Explore Now</button>
                                            </div>
                                        </div>
                                        <div class="newarraivalboxtext">
                                            <h5><a href="">{{ $varient_product->value_name }}</a> </h5>
                                            <h4><a href="">{{ $varient_product->variant_name }}</a></h4>
                                            <h6> <i class="fa-solid fa-indian-rupee-sign"></i> {{ $varient_product->price }}
                                                {{-- <span>Was <i class="fa-solid fa-indian-rupee-sign"></i>  700</span>   --}}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    @endif
                    
        </div>
        @if($latest_products->count() > 12)
            <div class="newarraivalbtn">
                <button type="button" class="btn btn-outline-light">Show More</button>
            </div>
        @endif    
    </div>
</section>

<!---------------------------------newarrivalend--------------------------------------->

<!--------------------------------blog------------------------------------------------>

<section class="mt-60">
  <div class="container">
      <div class="categoriestextcenter">
          <h2>From Our Blog</h2>
          </div>
      <div class="row">
          <div class="col-lg-4 mt-3">
              <div class="blogbox">
                  <div class="blogboximg">
                      <img src="{{ asset('img/blog1.jpg')}}" alt="" class="img-fluid">
                  </div>
                  <div class="blogboxtext">
                      <div class="blogboxtextdate">
                          <h6><a href="">Nov 22 , 2018</a></h6>
                          <p> | Comments</p>
                     
                      </div>
                      <h4><a href="">Sed adipiscing ornare.</a></h4>
                      <h6><a href="">Read More</a></h6>
                  </div>
              </div>
          </div>
          <div class="col-lg-4 mt-3">
              <div class="blogbox">
                  <div class="blogboximg">
                      <img src="{{ asset('img/blog2.jpg')}}" alt="" class="img-fluid">
                  </div>
                  <div class="blogboxtext">
                      <div class="blogboxtextdate">
                          <h6><a href="">Nov 22 , 2018</a></h6>
                          <p> | Comments</p>
                     
                      </div>
                      <h4><a href="">Fusce lacinia arcuet nulla.</a></h4>
                      <h6><a href="">Read More</a></h6>
                  </div>
              </div>
          </div>
          <div class="col-lg-4 mt-3">
              <div class="blogbox">
                  <div class="blogboximg">
                      <img src="{{ asset('img/blog3.jpg')}}" alt="" class="img-fluid">
                  </div>
                  <div class="blogboxtext">
                      <div class="blogboxtextdate">
                          <h6><a href="">Nov 22 , 2018</a></h6>
                          <p> | Comments</p>
                     
                      </div>
                      <h4><a href="">Quisque volutpat mattis eros.</a></h4>
                      <h6><a href="">Read More</a></h6>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>

<!--------------------------------blogend------------------------------------------------>

@endsection