@extends('../layouts.home_layout')

@section('maincontent')


<section>

    <!---------------------------Bedcramps---------------------------->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="categoriesbedcramps">
                        <ul>
                            <li><a href="">Home</a> &nbsp;&nbsp; <i class="fa-solid fa-chevron-right"></i></li>
                            <li>Categories</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!---------------------------Bedcrampsend---------------------------->


    <!----------------------------filters--------------------------->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-2 mt-3">
                    <div class="filtersbox">
                        <p>Filters</p>
                        <h6><a href="">Clean All</a></h6>
                    </div>
                </div>
                <div class="col-lg-4 mt-3">
                    <div class="showingbox">
                        <p>Showing <span> 9 of 56</span> Products </p>
                    </div>
                </div>
                <div class="col-lg-6 mt-3">
                    <div class="sortby">
                        <p>Sort By: </p>
                        <select>
                            <option value="">Sort By : What's New</option>
                            <option value="">Most Popular</option>
                            <option value="">Most Rated </option>
                            <option value="">Date </option>
                        </select>
                    </div>
                </div>
            </div>
            <!----------------------------filtersend--------------------------->
            <!------------------- categories ------------------------->

            <section class="mt-30down">
                <div class="row">
                    <div class="col-lg-2 mt-3">
                        @include('maincontents.product.filter_section')
                    </div>

                    <!-- ------------------------------------------------------------------ -->
                    <!--------------- Shop :: Product listing section : Start ---------------->
                    <!-- ------------------------------------------------------------------ -->

                    <div class="col-lg-10 mt-3 mt-30down">
                        <div class="categoriesright">
                            <div class="row">

                                <!-- Loop start for showing product -->
                                @if(!empty($products))
                                    @foreach($products as $product)
                                        @if(!empty($product->product_varients))
                                            @foreach($product->product_varients as $variant)

                                                        @php 
                                                        //dd($variant->productImages->first()->image_name);
                                                        $p_image_path = ( !empty($variant->productImages->first()) && $variant->productImages->first()->image_name!="") ? asset(config('constants.PRODUCT_IMAGE_PATH').$variant->productImages->first()->image_name) : asset('img/boxed-bg.jpg')
                                                        @endphp
                                                            <div class="col-lg-3 mt-3">
                                                                <div class="categoriesrightbox">
                                                                    <div class="categoriesrightboximg">
                                                                        <div class="categoriesrightboximg1">
                                                                            <img src="{{ asset($p_image_path) }}" alt="" class="img-fluid">

                                                                            <div class="categoriesrightboximg1addtocart">
                                                                                <i class="fa-solid fa-cart-shopping"></i>
                                                                                <p>Add To Cart</p>
                                                                            </div>
                                                                            <div class="categoriesrightboximg1wishlist">
                                                                                <i class="fa-regular fa-heart"></i>
                                                                                <!-- <p>Add To Wishlist</p> -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="categoriesrightboxtext">
                                                                        {{-- <h5>
                                                                            @foreach($varient_product['attributes_with_values'] as $attrArr)
                                                                                {{ $attrArr["attributes"]['attribute_name'] }} : {{ $attrArr["value_name"] }}
                                                                            @endforeach
                                                                        </h5> --}}
                                                                        <h6>{{ $variant->variant_name }} {{ $variant->attributesWithValues->where('attribute_id', '1')->first()->value_name }} </h6>
                                                                        <p><i class="fa-solid fa-indian-rupee-sign"></i> {{ $variant->price }}</p>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                


                                            @endforeach            
                                        @endif
                                    @endforeach
                                @endif
                                <!-- ------------------------------ -->

                                
                                
                                
                            </div>
                        </div>
                    </div>

                    <!-- ---------------------------------------------------------------- -->
                    <!--------------- Shop :: Product listing section : End ---------------->
                    <!-- ---------------------------------------------------------------- -->

                </div>
            </section>


        </div>
    </section>

</section>

@push('PAGE_ASSETS_JS')

@endpush

@endsection