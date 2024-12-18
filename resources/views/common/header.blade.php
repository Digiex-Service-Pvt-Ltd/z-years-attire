@php 
$user = Auth::guard('user')->user();
@endphp

<!-------------------------headertop--------------------->
<div class="headertopbody">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
            <div class="headertopleft dis-none">
                <div class="headertoplefticon">
                 <div class="headertoplefticon">
                    <i class="fa-solid fa-phone"></i>
                 </div>
                 <div class="headertopleftcall">
                    <p>Call :<span><a href="tel:+91 78906 09412">+91 78906 09412</a></span></p>
                 </div>
                </div>
            </div>
            </div>
            <div class="col-lg-8">
                <div class="headertopright">
                    <div class="headertoprightsocial">
                        <ul>
                            <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-pinterest-p"></i></a></li>
                            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                        </ul>
                    </div>
                    <div class="headertoprightuser">
                        <i class="fa-regular fa-user"></i>
                        @if (!empty($user))
                            <p>{{ $user->name; }}</p>
                        @else
                            <p>login</p> 
                        @endif
    
                        <div class="headertoprightuserdropdown">
                            <div class="loginboxmaintext">
                                @if (!empty($user))
                                    <h5>Welcome</h5>
                                    <p>To Access <a href="{{Route('user.profile')}}" class="link-secondary text text-decoration-none">Profile Page</a></p>
                                @else
                                    <h5>Welcome</h5>
                                    <p>To access account and manage orders</p>
                                @endif
                            </div>
                            @if (empty($user))
                                <div class="loginboxmainbutton">
                                    <a href="{{Route('user.login')}}"><button type="button" class="btn btn-outline-light">LogIn / SighnUp</button></a>
                                </div>
                            @else
                                <div class="loginboxmainbutton">
                                    <a href="{{ route('user.logout') }}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('form.logout').submit()">Logout </a>
                                    <form id="form.logout" method="post" action="{{ route('user.logout') }}">@csrf</form>
                                </div> 
                            @endif
                            <div class="loginboxmainorders">
                                <ul>
                                    <li><a href="">Oders </a></li>
                                    <li ><a href="">WishList </a></li>
                                    <li><a href="">Contact Us </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
    
                    
                </div>
            </div>
        </div>
    </div>
</div>
    
    
<!-------------------------headertopend--------------------->