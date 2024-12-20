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
                                    <li><a href="{{ url('shop/'.$category['slug']) }}">{{ $category['text'] }}<i class="fa-solid fa-angle-down"></i></a>
                                        <div class="megamenu">
                                            <div class="megamenu1">
                                                <div class="megamenu1navigation">
                                                    <div class="megamenu1navigationtext">
                                                        @if(!empty($category['children']))
                                                            <ul class="row">
                                                                @foreach($category['children'] as $child)
        
                                                                    <div class="col-sm">
                                                                        <div class="megamenu1navigationcolor">
                                                                            <li>
                                                                                <a class="megamenu1navigationcolor" href="{{ url('shop/'.$child['slug']) }}">{{ $child['text'] }}</a>
                                                                            </li>
                                                                        </div>
                                                                        @if(!empty($child['children']))
                                                                            @foreach($child['children'] as $child2)
                                                                            <li><a href="{{ url('shop/'.$child2['slug']) }}">{{ $child2['text'] }}</a></li>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                </div>
                                                {{-- <div class="megamenu1navigation">
                                                    <div class="megamenu1navigationtext">
                                                        <ul>
                                                            <div class="megamenu1navigationcolor">
                                                                <li><a href=""
                                                                        class="megamenu1navigationcolor">TopWear</a>
                                                                </li>
                                                            </div>
                                                            <li><a href="">T-Shert</a></li>
                                                            <li><a href="">Casual Sherts</a></li>
                                                            <li><a href="">Formal Sherts</a></li>
                                                            <li><a href="">Sweartsherts</a></li>
                                                            <li><a href="">Sweaters</a></li>
                                                            <li><a href="">Jackets</a></li>
                                                            <li><a href="">Blazers & coats</a></li>
                                                            <li><a href="">Suits</a></li>
                                                            <li><a href="">Rain Jackets</a></li>
                                                            <li class="mt-mega20"><a href=""
                                                            class="megamenu1navigationcolor">Indian & Fes</a>
                                                            </li>
                                                            <li><a href="">Kurtas & kurta Sets</a></li>
                                                            <li><a href="">Sherwanies</a></li>
                                                            <li><a href="">Nehuru Jackets</a></li>
                                                            <li><a href="">Dhoties</a></li>
                                                        </ul>
                                                    </div>
                                                </div> --}}
                                                {{-- <div class="megamenu1navigation">
                                                    <div class="megamenu1navigationtext">
                                                        <ul>
                                                            <div class="megamenu1navigationcolor">
                                                                <li><a href=""
                                                                class="megamenu1navigationcolor">TopWear</a>
                                                                </li>
                                                            </div>
                                                            <li><a href="">T-Shert</a></li>
                                                            <li><a href="">Casual Sherts</a></li>
                                                            <li><a href="">Formal Sherts</a></li>
                                                            <li><a href="">Sweartsherts</a></li>
                                                            <li><a href="">Sweaters</a></li>
                                                            <li><a href="">Jackets</a></li>
                                                            <li><a href="">Blazers & coats</a></li>
                                                            <li><a href="">Suits</a></li>
                                                            <li><a href="">Rain Jackets</a></li>
                                                            <li class="mt-mega20"><a href=""
                                                            class="megamenu1navigationcolor">Indian & Fes</a>
                                                            </li>
                                                            <li><a href="">Kurtas & kurta Sets</a></li>
                                                            <li><a href="">Sherwanies</a></li>
                                                            <li><a href="">Nehuru Jackets</a></li>
                                                            <li><a href="">Dhoties</a></li>
                                                        </ul>
                                                    </div>
                                                </div> --}}
                                                {{-- <div class="megamenu1navigation">
                                                    <div class="megamenu1navigationtext">
                                                        <ul>
                                                            <div class="megamenu1navigationcolor">
                                                                <li><a href=""
                                                            class="megamenu1navigationcolor">TopWear</a>
                                                                </li>
                                                            </div>
                                                            <li><a href="">T-Shert</a></li>
                                                            <li><a href="">Casual Sherts</a></li>
                                                            <li><a href="">Formal Sherts</a></li>
                                                            <li><a href="">Sweartsherts</a></li>
                                                            <li><a href="">Sweaters</a></li>
                                                            <li><a href="">Jackets</a></li>
                                                            <li><a href="">Blazers & coats</a></li>
                                                            <li><a href="">Suits</a></li>
                                                            <li><a href="">Rain Jackets</a></li>
                                                            <li class="mt-mega20"><a href=""
                                                            class="megamenu1navigationcolor">Indian & Fes</a>
                                                            </li>
                                                            <li><a href="">Kurtas & kurta Sets</a></li>
                                                            <li><a href="">Sherwanies</a></li>
                                                            <li><a href="">Nehuru Jackets</a></li>
                                                            <li><a href="">Dhoties</a></li>
                                                        </ul>
                                                    </div>
                                                </div> --}}
                                                {{-- <div class="megamenu1navigation">
                                                    <div class="megamenu1navigationtext">
                                                        <ul>
                                                            <div class="megamenu1navigationcolor">
                                                                <li><a href=""
                                                            class="megamenu1navigationcolor">TopWear</a>
                                                                </li>
                                                            </div>
                                                            <li><a href="">T-Shert</a></li>
                                                            <li><a href="">Casual Sherts</a></li>
                                                            <li><a href="">Formal Sherts</a></li>
                                                            <li><a href="">Sweartsherts</a></li>
                                                            <li><a href="">Sweaters</a></li>
                                                            <li><a href="">Jackets</a></li>
                                                            <li><a href="">Blazers & coats</a></li>
                                                            <li><a href="">Suits</a></li>
                                                            <li><a href="">Rain Jackets</a></li>
                                                            <li class="mt-mega20"><a href=""
                                                                    class="megamenu1navigationcolor">Indian & Fes</a>
                                                            </li>
                                                            <li><a href="">Kurtas & kurta Sets</a></li>
                                                            <li><a href="">Sherwanies</a></li>
                                                            <li><a href="">Nehuru Jackets</a></li>
                                                            <li><a href="">Dhoties</a></li>
                                                        </ul>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                            {{-- <li><a href="">WoMen</a><i class="fa-solid fa-angle-down"></i>

                                <div class="megamenu">
                                    <div class="megamenu1">
                                        <div class="megamenu1navigation">
                                            <div class="megamenu1navigationtext">
                                                <ul>
                                                    <div class="megamenu1navigationcolor">
                                                        <li><a href=""
                                                                class="megamenu1navigationcolor">TopWear</a>
                                                        </li>
                                                    </div>
                                                    <li><a href="">T-Shert</a></li>
                                                    <li><a href="">Casual Sherts</a></li>
                                                    <li><a href="">Formal Sherts</a></li>
                                                    <li><a href="">Sweartsherts</a></li>
                                                    <li><a href="">Sweaters</a></li>
                                                    <li><a href="">Jackets</a></li>
                                                    <li><a href="">Blazers & coats</a></li>
                                                    <li><a href="">Suits</a></li>
                                                    <li><a href="">Rain Jackets</a></li>
                                                    <li class="mt-mega20"><a href=""
                                                            class="megamenu1navigationcolor">Indian & Fes</a>
                                                    </li>
                                                    <li><a href="">Kurtas & kurta Sets</a></li>
                                                    <li><a href="">Sherwanies</a></li>
                                                    <li><a href="">Nehuru Jackets</a></li>
                                                    <li><a href="">Dhoties</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="megamenu1navigation">
                                            <div class="megamenu1navigationtext">
                                                <ul>
                                                    <div class="megamenu1navigationcolor">
                                                        <li><a href=""
                                                                class="megamenu1navigationcolor">TopWear</a>
                                                        </li>
                                                    </div>
                                                    <li><a href="">T-Shert</a></li>
                                                    <li><a href="">Casual Sherts</a></li>
                                                    <li><a href="">Formal Sherts</a></li>
                                                    <li><a href="">Sweartsherts</a></li>
                                                    <li><a href="">Sweaters</a></li>
                                                    <li><a href="">Jackets</a></li>
                                                    <li><a href="">Blazers & coats</a></li>
                                                    <li><a href="">Suits</a></li>
                                                    <li><a href="">Rain Jackets</a></li>
                                                    <li class="mt-mega20"><a href=""
                                                            class="megamenu1navigationcolor">Indian & Fes</a>
                                                    </li>
                                                    <li><a href="">Kurtas & kurta Sets</a></li>
                                                    <li><a href="">Sherwanies</a></li>
                                                    <li><a href="">Nehuru Jackets</a></li>
                                                    <li><a href="">Dhoties</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="megamenu1navigation">
                                            <div class="megamenu1navigationtext">
                                                <ul>
                                                    <div class="megamenu1navigationcolor">
                                                        <li><a href=""
                                                                class="megamenu1navigationcolor">TopWear</a>
                                                        </li>
                                                    </div>
                                                    <li><a href="">T-Shert</a></li>
                                                    <li><a href="">Casual Sherts</a></li>
                                                    <li><a href="">Formal Sherts</a></li>
                                                    <li><a href="">Sweartsherts</a></li>
                                                    <li><a href="">Sweaters</a></li>
                                                    <li><a href="">Jackets</a></li>
                                                    <li><a href="">Blazers & coats</a></li>
                                                    <li><a href="">Suits</a></li>
                                                    <li><a href="">Rain Jackets</a></li>
                                                    <li class="mt-mega20"><a href=""
                                                            class="megamenu1navigationcolor">Indian & Fes</a>
                                                    </li>
                                                    <li><a href="">Kurtas & kurta Sets</a></li>
                                                    <li><a href="">Sherwanies</a></li>
                                                    <li><a href="">Nehuru Jackets</a></li>
                                                    <li><a href="">Dhoties</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="megamenu1navigation">
                                            <div class="megamenu1navigationtext">
                                                <ul>
                                                    <div class="megamenu1navigationcolor">
                                                        <li><a href=""
                                                                class="megamenu1navigationcolor">TopWear</a>
                                                        </li>
                                                    </div>
                                                    <li><a href="">T-Shert</a></li>
                                                    <li><a href="">Casual Sherts</a></li>
                                                    <li><a href="">Formal Sherts</a></li>
                                                    <li><a href="">Sweartsherts</a></li>
                                                    <li><a href="">Sweaters</a></li>
                                                    <li><a href="">Jackets</a></li>
                                                    <li><a href="">Blazers & coats</a></li>
                                                    <li><a href="">Suits</a></li>
                                                    <li><a href="">Rain Jackets</a></li>
                                                    <li class="mt-mega20"><a href=""
                                                            class="megamenu1navigationcolor">Indian & Fes</a>
                                                    </li>
                                                    <li><a href="">Kurtas & kurta Sets</a></li>
                                                    <li><a href="">Sherwanies</a></li>
                                                    <li><a href="">Nehuru Jackets</a></li>
                                                    <li><a href="">Dhoties</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="megamenu1navigation">
                                            <div class="megamenu1navigationtext">
                                                <ul>
                                                    <div class="megamenu1navigationcolor">
                                                        <li><a href=""
                                                                class="megamenu1navigationcolor">TopWear</a>
                                                        </li>
                                                    </div>
                                                    <li><a href="">T-Shert</a></li>
                                                    <li><a href="">Casual Sherts</a></li>
                                                    <li><a href="">Formal Sherts</a></li>
                                                    <li><a href="">Sweartsherts</a></li>
                                                    <li><a href="">Sweaters</a></li>
                                                    <li><a href="">Jackets</a></li>
                                                    <li><a href="">Blazers & coats</a></li>
                                                    <li><a href="">Suits</a></li>
                                                    <li><a href="">Rain Jackets</a></li>
                                                    <li class="mt-mega20"><a href=""
                                                            class="megamenu1navigationcolor">Indian & Fes</a>
                                                    </li>
                                                    <li><a href="">Kurtas & kurta Sets</a></li>
                                                    <li><a href="">Sherwanies</a></li>
                                                    <li><a href="">Nehuru Jackets</a></li>
                                                    <li><a href="">Dhoties</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li> --}}
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