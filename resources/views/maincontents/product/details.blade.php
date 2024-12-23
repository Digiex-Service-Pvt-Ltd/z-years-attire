@extends('../layouts.home_layout')

@section('maincontent')

@push('PAGE_ASSETS_CSS')
<link href="{{ asset('css/stylezoom.css') }}" rel="stylesheet">
@endpush

<section>

    <!---------------------------Bedcramps---------------------------->

    {{-- <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="categoriesbedcramps">
                        <ul>
                            <li><a href="">Home</a> &nbsp;&nbsp; <i class="fa-solid fa-chevron-right"></i></li>
                            <li><a href="">Categories</a></li>&nbsp;&nbsp; <i class="fa-solid fa-chevron-right mt-1"></i> <li><a href="">Product Extend</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!---------------------------Bedcrampsend---------------------------->


    <!----------------------------------extended------------------------------->

<section>
<div class="container">
    <div class="row">
        <div class="col-lg-5 mt-3">
            <div class="row">
                @if(!empty($varient_dtls['product_images']))
                    @foreach($varient_dtls['product_images'] as $image)
                        <div class="col-lg-2 col-2 mt-2 px-0">
                            <div class="thumbs">
                                <img src="{{ asset(config('constants.PRODUCT_IMAGE_PATH')).'/'.$image['image_name'] }}" alt="{{ $image['image_name'] }}" title="{{ $image['image_name'] }}" class="thumb">
                            </div>
                        </div>
                    @endforeach
                    <div class="col-lg-10 col-10 mt-2 px-0">
                        <div id="gallery-box" class="gallery-box">
                            <div class="zoomed-image"></div>
                        
                        </div>
                    </div>
                @else
                    <div class="col-lg-10 col-10 mt-2 px-0">
                        <div id="gallery-box" class="gallery-box">
                            <div class="zoomed-image"></div>
                        
                        </div>
                    </div>
                @endif
            </div>
            
        </div>
        <div class="col-lg-7 mt-3 pl-20">
            <div class="extendedpageright">
                <div class="extendedpagerightheadertext">
                    <h2>{{ $varient_dtls['variant_name'] }}</h2>
                </div>
                
                <div class="extendedpagerightheaderprice pt-2">
                    <p><i class="fa-solid fa-indian-rupee-sign"></i> {{ $varient_dtls['price'] }}</p>
                </div>
                <div class="extendedpagerightheadertext">
                
                </div>
                <div class="extendedpagerightcolor pt-4">
                    <p>Color
                        @if(!empty($color_attr))
                            <div class="extendedpagerightcolormain">
                                @foreach($color_attr as $color)
                                    <a href="{{ url('product/'.$product['slug'].'/'.$color['varient_id']) }}" title="{{ $color['value_name'] }}" class="{{ ($color['selected']) ? 'active' : '' }}"><div style="background-color: {{ $color['hexa_color_code'] }}"></div></a>
                                @endforeach
                            </div>
                        @endif
                </div>
                <div class="sizeBox pt-3">
                    <p>Size:</p>
                 <div class="sizeboxmain">
                    @if(!empty($size_attr))
                        @foreach($size_attr as $size)
                            @php 
                                //$active_status = ($varient_dtls['id'] == $size['varient_id']) ? 'active' : '';  
                                $stock_status = ($size['stock_qty'] == 0) ? 'inact' : '';  
                            @endphp
                            <div class="sizeboxmainbox {{ $stock_status }}">
                                @if($size['stock_qty'] >0)
                                    <p><a href="#">{{ $size['value_name'] }}</a></p>
                                @else
                                    <p>{{ $size['value_name'] }}</p>
                                @endif
                            </div>
                        @endforeach
                    @endif    
                 </div>
                </div>
                
                <div class="productextendaddtocart">
                    <div class="productextendaddtocart1">
                        <button type="button" class="btn btn-outline-warning px-5"><i class="fa-solid fa-cart-shopping"></i> Add To Cart</button>
                    </div>
                    <div class="productextendaddtocart1">
                        <button type="button" class="btn btn-outline-warning px-5"><i class="fa-regular fa-heart"></i> Add To Wishlist</button>
                    </div>
                </div>

                
                <div class="productextendshare">
                    <ul>
                        <li class="pe-3">Share :</li>
                        <li><a href=""><i class="fa-brands fa-facebook-f"></i></a></li>
                        <li><a href=""><i class="fa-brands fa-x-twitter"></i></a></li>
                        <li><a href=""><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href=""><i class="fa-brands fa-pinterest-p"></i></a></li>
                    </ul>
                </div>

                <!----------------------productdetails------------------->

                <div class="productdetailstext">
                    {{-- <h5>Product Details</h5>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellendus quasi provident culpa labore cum. Illum quibusdam modi, ullam qui officiis quasi deleniti ratione, ex laudantium maxime quidem quae nostrum ea?</p> --}}
                    <h5>Product Details</h5>
                    <p>{{ $product['description'] }}</p>
                </div>
            </div>
        </div>


        </div>
        </div>

<!------------------------extendedright--------------------->

  

        <!------------------------extendedrightend--------------------->
    </div>
</div>
</section>

    <!----------------------------------extendedend------------------------------->

</section>



@push('PAGE_ASSETS_JS')
<script src="{{ asset('js/script-zoom.js')}}"></script>
<script>
    vanillaZoom.init({
        container: '#gallery-box',
        imageClass: '.thumb',
        zoomedClass: '.zoomed-image'
    });
</script>
@endpush

@endsection