@extends('../layouts.home_layout')

@section('maincontent')

<section>
@push('PAGE_ASSETS_CSS')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css" />

@endpush

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
                        <h6><a href="{{ url()->current() }}">Clean All</a></h6>
                    </div>
                </div>
                <div class="col-lg-4 mt-3">
                    <div class="showingbox">
                        <p>Showing <span> {{ $total_record }}</span> Products </p>
                    </div>
                </div>
                <div class="col-lg-6 mt-3">
                    <div class="sortby">
                        <p>Sort By: </p>
                        <select>
                            <option value="">Sort By : What's New</option>
                            <option value="">Most Popular</option>
                            <option value="">Most Rated </option>
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
                                @if(!empty($child_categories))
                                    <div class="categoriesleftlist">
                                        <ul>
                                        @foreach($child_categories as $child_category)
                                            <li><a href="">
                                                <div class="categoriesleftlistcheck">
                                                <input type="checkbox" class="catP" name="cat[]" value="{{ $child_category->id }}" {{ (in_array($child_category->id, $selected_category)) ? 'checked="checked"' : "" }}>{{ $child_category->category_name }}</div>
                                            </a></li>
                                        @endforeach        
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <!-- ---- Category Section :: End --- -->
                        
                            <!-- -------- Product attributes section :: Start --------- -->
                            @if(!empty($attributes))
                                @foreach($attributes as $attribute)
                                    
                                @if($attribute->id == 1)
                                        <!-- For color attribute -->
                                        <div class="colorbox">
                                            <h5>{{ $attribute->attribute_name }}</h5>
                                            @if($attribute->attribute_values->isNotEmpty())
                                                @foreach($attribute->attribute_values as $attribute_value)
                                                    <div class="colorboxmain mt-10down">
                                                        <div class="colorboxmain1">
                                                            <input type="checkbox" id="attr{{ $attribute_value->id }}" name="color[]" value="{{ $attribute_value->id }}" class="color" {{ (in_array($attribute_value->id, $selected_color)) ? 'checked="checked"' : "" }}>
                                                            <div style="background-color: {{ $attribute_value->hexa_color_code }}"></div>
                                                            <label for="attr{{ $attribute_value->id }}" class="text-secondary"> {{ $attribute_value->value_name }}
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
                                                                <input type="checkbox" id="attr{{ $attribute_value->id }}" name="size[]" value="{{ $attribute_value->id }}" class="size" {{ (in_array($attribute_value->id, $selected_size)) ? 'checked="checked"' : "" }}>
                                                                <label for="attr{{ $attribute_value->id }}" class="text-secondary"> {{ $attribute_value->value_name }}
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
                        
                            <!--------------- Filter by price :: Start -------------------->
                            <section>
                                <div class="pricebox ">
                                    <h5>Price</h5>
                                    <input type="text" id="range-slider" name="range" value="" />
                                    
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


                            @if(!empty($selected_size)) <!-- Size attribute selected -->

                                <!-- Loop start for showing product -->
                                @if(!empty($products))
                                    @foreach($products as $varient_product)
                                    @php
                                    $p_image_path = ( !empty($varient_product->productImages) && $varient_product->productImages->first()->image_name !="") ? asset(config('constants.PRODUCT_IMAGE_PATH'). $varient_product->productImages->first()->image_name) : asset('img/boxed-bg.jpg')
                                    @endphp
                                        <div class="col-lg-3 mt-3">
                                            <div class="categoriesrightbox">
                                                <div class="categoriesrightboximg">
                                                    <div class="categoriesrightboximg1">
                                                        <a href="{{ url('product/'.$varient_product->products->slug.'/'.$varient_product->id) }}"><img src="{{ $p_image_path }}" alt="" class="img-fluid"></a>

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
                                                    <h5>
                                                        @foreach($varient_product->attributesWithValues as $attrArr)
                                                            {{ $attrArr->attributes->attribute_name }} : {{ $attrArr->value_name }}
                                                        @endforeach
                                                    </h5>
                                                    <a href="{{ url('product/'.$varient_product->products->slug.'/'.$varient_product->id) }}"><h6>{{ $varient_product->variant_name }}</h6></a>
                                                    <p><i class="fa-solid fa-indian-rupee-sign"></i> {{ $varient_product->price }}</p>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <!-- ------------------------------ -->

                            @else

                                    @if(!empty($products))
                                        @foreach($products as $product)
                                            @if(!empty($product->product_varients))
                                                @foreach($product->product_varients as $variant)

                                                    @php 
                                                    //echo "<pre>"; print_r($product->product_varients->toArray()); die();
                                                    $p_image_path = ( !empty($variant->productImages->first()) && $variant->productImages->first()->image_name!="") ? asset(config('constants.PRODUCT_IMAGE_PATH').$variant->productImages->first()->image_name) : asset('img/boxed-bg.jpg')
                                                    @endphp
                                                    <div class="col-lg-3 mt-3">
                                                        <div class="categoriesrightbox">
                                                            <div class="categoriesrightboximg">
                                                                <div class="categoriesrightboximg1">
                                                                    <a href="{{ url('product/'.$product->slug.'/'.$variant->id) }}"><img src="{{ $p_image_path }}" alt="" class="img-fluid"></a>

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
                                                                <h5>
                                                                    @foreach($variant->attributesWithValues as $attrArr)
                                                                        {{ $attrArr->attributes->attribute_name }} : {{ $attrArr->value_name }}
                                                                    @endforeach
                                                                </h5>
                                                                <a href="{{ url('product/'.$product->slug.'/'.$variant->id) }}"><h6>{{ $variant->variant_name }} </h6></a>
                                                                <p><i class="fa-solid fa-indian-rupee-sign"></i> {{ $variant->price }}</p>

                                                            </div>
                                                        </div>
                                                    </div>

                                                @endforeach            
                                            @endif
                                        @endforeach
                                    @endif


                            @endif
                                
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
<script>
    $(document).ready(function () {
        
        $("#range-slider").ionRangeSlider({
            type: "double",
            min: 100,
            max: 5000,
            from: {{ $min_price }},
            step: 10,
            to: {{ $max_price }},
            max_postfix: "+",
            prefix: "Rs.",
            grid: true,
            skin: "flat",
            onFinish: function(){
                apply_filter();
            }
        });

        //Save instance to variable
        let slider = $("#range-slider").data("ionRangeSlider");
        
        $('.catP').on('change', function(){
            apply_filter();
        });

        $('.color').on('change', function(){
            apply_filter();
        });

        $('.size').on('change', function(){
            apply_filter();
        });

        function apply_filter()
        {
            let priceSearchEnable = '{{ $price_search_enable }}';
            let url = '{{ url()->current() }}?';

            //for categories
            let categories = [];
            $('.catP').each(function(e){
                if( $(this).is(":checked") == true ){
                    categories.push($(this).val());
                }   
            });
            //console.log(categories);
            if(categories.length >0){
                url = url + '&c='+categories.toString();
            }

            //for color
            let colors = [];
            $('.color').each(function(e){
                if( $(this).is(":checked") == true ){
                    colors.push($(this).val());
                }   
            });
            //console.log(colors);
            if(colors.length >0){
                url = url + '&color='+colors.toString();
            }

            //for size
            let sizes = [];
            $('.size').each(function(e){
                if( $(this).is(":checked") == true ){
                    sizes.push($(this).val());
                }   
            });
            //console.log(sizes);
            if(sizes.length >0){
                url = url + '&size='+sizes.toString();
            }
            
            if(priceSearchEnable){
                url = url + '&min_price='+slider.result.from+'&max_price='+slider.result.to;
            }
            
            //console.log(url);
            window.location.href = url;
            

        }


    });
</script>

@endpush

@endsection