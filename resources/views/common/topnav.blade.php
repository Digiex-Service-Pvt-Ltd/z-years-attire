<!-----------------------------navigation------------------------------->
@php 
$categories = get_category_treeview();
//dd($categories);
@endphp
    
<section class="navcontrol">
    <div class="navigationbox">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="headernav">
                        <ul>
                            <div class="rescross">
                                <i class="fa-solid fa-xmark"></i>
                            </div>

                            <div class="ressearch">
                                <input type="text" placeholder="search">
                                <div class="ressearch1">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </div>
                            </div>

                            <!-- Dynamic menu section -->
                            @if(!empty($categories))
                                @foreach($categories as $category)
                                    <li><a href="{{ url('category/'.$category['slug']) }}">{{ $category['text'] }}</a>
                                        @if(!empty($category['children']))
                                            <i class="fa-solid fa-angle-down"></i>
                                            <ul class="submenu">
                                                @foreach($category['children'] as $child)
                                                <li><a href="{{ url('category/'.$child['slug']) }}">{{ $child['text'] }}</a>

                                                    @if(!empty($child['children']))
                                                    <i class="fa-solid fa-angle-down"></i>
                                                    <ul class="submenu">
                                                        @foreach($child['children'] as $child2)
                                                        <li><a href="{{ url('category/'.$child2['slug']) }}">{{ $child2['text'] }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                    @endif

                                                </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            @endif
                            <!-- Dynamic menu end -->

                            <li><a href="">Blog</a></li>
                            <div class="ressocial">
                                <a href=""><i class="fa-brands fa-facebook-f"></i></a>
                                <a href=""><i class="fa-brands fa-x-twitter"></i></a>
                                <a href=""><i class="fa-brands fa-instagram"></i></a>
                                <a href=""><i class="fa-brands fa-youtube"></i></a>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="headernavigationright">
                        <div class="headernavigationrighticon">
                            <i class="fa-regular fa-lightbulb"></i>
                            <p>Clearance Up to 30% Off</p>
                        </div>
                    </div>
                    <div class="resbtn">
                        <i class="fa-solid fa-bars"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-----------------------------navigationend------------------------------->