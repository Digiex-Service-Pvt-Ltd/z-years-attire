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
                            <option>Sort By :<span>What's New</span></option>
                            <option>Most Popular</option>
                            <option>Most Rated </option>
                            <option>Date </option>
                        </select>
                    </div>
                </div>
            </div>
            <!----------------------------filtersend--------------------------->
            <!------------------- categories ------------------------->

            <section class="mt-30down">
                <div class="row">
                    <div class="col-lg-2 mt-3">
                        <div class="categoriesimgdetailsleft">

                            <!-- ---- Category Section start :: Start --- -->
                            <div class="categoriesleft">
                                <h5>Categories</h5>
                                <div class="categoriesleftlist">
                                    <ul>
                                        <li><a href="">
                                            <div class="categoriesleftlistcheck">
                                            <input type="checkbox">Jeans</div>
                                        </a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- ---- Category Section :: End --- -->

                            <!-- -------- Product attributes section :: Start --------- -->
                            @if($attributes->isNotEmpty())
                                @foreach($attributes as $attribute)
                                    
                                @if($attribute->id == 1)
                                        <!-- For color attribute -->
                                        <div class="colorbox">
                                            <h5>{{ $attribute->attribute_name }}</h5>
                                            @if($attribute->attribute_values->isNotEmpty())
                                                @foreach($attribute->attribute_values as $attribute_value)
                                                    <div class="colorboxmain mt-10down">
                                                        <div class="colorboxmain1">
                                                            <input type="checkbox" value="{{ $attribute_value->id }}">
                                                            <div style="background-color: {{ $attribute_value->hexa_color_code }}"></div>
                                                            <p>{{ $attribute_value->value_name }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        
                                    @else
                                        <!-- For other attributes -->
                                        <div class="sizebox">
                                            <h5>{{ $attribute->attribute_name }}</h5>
                                            <div class="sizeboxmain">
                                                @if($attribute->attribute_values->isNotEmpty())
                                                <ul>
                                                    @foreach($attribute->attribute_values as $attribute_value)
                                                        <li class="mt-20down">
                                                            <div class="sizeboxmain1">
                                                                <input type="checkbox" value="{{ $attribute_value->id }}">
                                                                <p><a href="#">{{ $attribute_value->value_name }}</a></p>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                        

                                @endforeach
                            @endif
                            
                            <!---------- Product attributes section :: End ----------->

                            <!------------------------ color---------------------------->

                            {{-- <section>
                                <div class="colorbox">
                                    <h5>Colour</h5>
                                        <div class="colorboxmain mt-10down">
                                            <div class="colorboxmain1">
                                                <input type="checkbox">
                                                <div style="background-color: #b87145;"></div>
                                                <p>Orange</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section> --}}

                            <!------------------ colorend ------------------------->


                            <!--------------- Filter by price :: Start -------------------->
                            <section>
                                <div class="pricebox ">
                                    <h5>Price</h5>
                                    <h6>Price Range :<span> <i class="fa-solid fa-indian-rupee-sign"></i> 0 - <i
                                                class="fa-solid fa-indian-rupee-sign"></i> 1200 </span></h6>
                                    <div class="pricevalue">
                                        <input type="range" min="0" max="1200" class="accent">
                                    </div>
                                    <div class="pricevalue1">
                                        <div class="pricevalue_1">
                                            <p> <i class="fa-solid fa-indian-rupee-sign"></i> 0 </p>
                                            <p> <i class="fa-solid fa-indian-rupee-sign"></i> 1200</p>
                                        </div>

                                    </div>
                                </div>
                            </section>
                            <!--------------- Filter by price :: End -------------------->



                        </div>
                    </div>

                    <!-- ------------------------------------------------------------------ -->
                    <!--------------- Shop :: Product listing section : Start ---------------->
                    <!-- ------------------------------------------------------------------ -->

                    <div class="col-lg-10 mt-3 mt-30down">
                        <div class="categoriesright">
                            <div class="row">

                                <!-- Loop start for showing product -->
                                @if(!empty($products))
                                    @foreach($products as $varient_product)
                                        <div class="col-lg-3 mt-3">
                                            <div class="categoriesrightbox">
                                                <div class="categoriesrightboximg">
                                                    <div class="categoriesrightboximg1">
                                                        <img src="img/categories-1.jpg" alt="" class="img-fluid">

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
                                                    <h5>Woman</h5>
                                                    <h6>Brown paperbag waist pencil skirt</h6>
                                                    <p><i class="fa-solid fa-indian-rupee-sign"></i> 200.00</p>

                                                </div>
                                            </div>
                                        </div>
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

@endsection