@if (!(Request::has("iframe") && Request::get("iframe") == "true"))
  <!-- Navbar STart -->
  <header id="topnav" class="defaultscroll sticky">
        <div class="container">
            <!-- Logo container-->
            <div>
                <a class="logo" href="{{url('/')}}">
                    <img src="{{asset('images/logo.png')}}" alt="">
                </a>
            </div>
            @auth
            @else
            <div class="buy-button">
                <a href="{{route('login')}}" class="btn">Login</a>
                <a href="{{route('signup')}}" class="btn btn-primary">Sign Up</a>
            </div><!--end login button-->
            @endauth
            <!-- End Logo container-->
            <div class="menu-extras">
                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>

            <div id="navigation">
             
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
               @if (Auth::check())
                  @php
                
                 $subscription = App\Models\Subscription::where('user_id', Auth::user()->id)->first();
                
                
                @endphp
                        @if (isset($subscription) && $subscription->subscription_type == 1)
                          
                        @else
                          <li class="nav-item">
                                <a class="nav-link" href="" data-toggle="modal" data-target=".upgraderModal">Upgrade Account</a>
                            </li>
                        {{-- change --}}
                         
                            @endif
                    <li> <a href="{{route('profile.index', 'profile')}}">Profile</a></li>
                    <li> <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Off</a></li>

                 @else
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li><a href="{{route('features')}}">Features</a></li>
                    <li><a href="{{route('pricing')}}">Pricing</a></li>
                    <li><a href="{{route('contact')}}">Contact</a></li>

                    @endif
                </ul><!--end navigation menu-->
                <div class="buy-menu-btn d-none">
                    <a href="{{route('login')}}" class="btn">Login</a>
                    <a href="{{route('signup')}}" class="btn btn-primary">Sign Up</a>
                </div><!--end login button-->
            </div><!--end navigation-->
        </div><!--end container-->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </header><!--end header-->
    <!-- Navbar End -->
@endif


















