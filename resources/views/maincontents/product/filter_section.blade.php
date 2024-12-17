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
                                    <input type="checkbox" name="color[]" value="{{ $attribute_value->id }}" class="color" {{ (in_array($attribute_value->id, $selected_color)) ? 'checked="checked"' : "" }}>
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
                                        <input type="checkbox" name="size[]" value="{{ $attribute_value->id }}" class="size" {{ (in_array($attribute_value->id, $selected_size)) ? 'checked="checked"' : "" }}>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        
        $('.catP').on('change', function(){
            apply_filter();
        });

        $('.color').on('change', function(){
            apply_filter();
        });

        $('.size').on('change', function(){
            apply_filter();
        });

        function apply_filter(){
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
            
            window.location.href = url;

        }

    });
</script>