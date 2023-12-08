<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Broccoli - Organic Food HTML Template</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Place favicon.png in the root directory -->
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}" type="image/x-icon" />
    <!-- Font Icons css -->
    <link rel="stylesheet" href="{{asset('css/font-icons.css')}}">
    <!-- plugins css -->
    <link rel="stylesheet" href="{{asset('css/plugins.css')}}">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <!-- All JS Plugins -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="{{asset('js/plugins.js')}}"></script>

    <script src="{{asset('js/main.js')}}"></script>


</head>

<body>


<!-- Add your site or application content here -->
<!-- Body main wrapper start -->
<div class="wrapper">
    <!-- HEADER AREA START (header-5) -->
    <header class="ltn__header-area ltn__header-5 ltn__header-transparent-- gradient-color-4">


        <!-- ltn__header-top-area start -->
        <div class="ltn__header-top-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="ltn__top-bar-menu">
                            <ul>
                                <li><a href="locations.html"><i class="icon-placeholder"></i> 15/A, Nest Tower, NYC</a></li>
                                <li><a href="mailto:info@webmail.com?Subject=Flower%20greetings%20to%20you"><i class="icon-mail"></i> info@webmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="top-bar-right text-right text-end">
                            <div class="ltn__top-bar-menu">
                                <ul>
                                    <li>
                                        <!-- ltn__language-menu -->
                                        <div class="ltn__drop-menu ltn__currency-menu ltn__language-menu">
                                            <ul>
                                                <li><a href="#" class="dropdown-toggle"><span class="active-currency">English</span></a>
                                                    <ul>
                                                        <li><a href="#">Arabic</a></li>
                                                        <li><a href="#">Bengali</a></li>
                                                        <li><a href="#">Chinese</a></li>
                                                        <li><a href="#">English</a></li>
                                                        <li><a href="#">French</a></li>
                                                        <li><a href="#">Hindi</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <!-- ltn__social-media -->
                                        <div class="ltn__social-media">
                                            <ul>
                                                <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>

                                                <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                                                <li><a href="#" title="Dribbble"><i class="fab fa-dribbble"></i></a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ltn__header-top-area end -->

        <!-- ltn__header-middle-area start -->
        <div class="ltn__header-middle-area ltn__header-sticky ltn__sticky-bg-white ltn__logo-right-menu-option plr--9---">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="site-logo-wrap">
                            <div class="site-logo">
                                <a href="/"><img src="{{asset('img/logo.png')}}" alt="Logo"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col header-menu-column menu-color-white---">
                        <div class="header-menu d-none d-xl-block">
                            <nav>
                                <div class="ltn__main-menu">
                                    <ul>
                                        <li class="menu-icon"><a href="#">Home</a>
                                            <ul class="sub-menu menu-pages-img-show ltn__sub-menu-col-2---">
                                                <li>
                                                </li>
                                                <li>
                                                </li>
                                                <li>
                                                </li>
                                                <li>
                                                </li>
                                                <li>
                                                </li>
                                                <li>
                                                </li>
                                                <li>
                                                </li>
                                                <li>
                                                </li>
                                                <li>
                                                </li>
                                                <li>
                                                </li>
                                                <li>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="menu-icon"><a href="#">About</a>
                                            <ul>
                                            </ul>
                                        </li>

                                        <li><a href="{{ route('shop.index') }}">{{__('Shop site') }}</a></li>
                                        <li class="menu-icon"><a href="#">News</a>
                                            <ul>

                                            </ul>
                                        </li>
                                        <li class="menu-icon"><a href="#">Pages</a>
                                            <ul class="mega-menu">
                                                <li><a href="#">Inner Pages</a>
                                                    <ul>

                                                    </ul>
                                                </li>
                                                <li><a href="#">Inner Pages</a>
                                                    <ul>

                                                    </ul>
                                                </li>
                                                <li><a href="#">Shop Pages</a>
                                                    <ul>

                                                    </ul>
                                                </li>
                                                <li>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a>Contact</a></li>
                                        <li class="special-link"><a>GET A QUOTE</a></li>
                                        <li></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>

                    <div class="ltn__header-options ltn__header-options-2 mb-sm-20">
                        <!-- header-search-1 -->
                        <div class="header-search-wrap">
                            <div class="header-search-1">
                                <div class="search-icon">
                                    <i class="icon-search for-search-show"></i>
                                    <i class="icon-cancel  for-search-close"></i>
                                </div>
                            </div>
                            <div class="header-search-1-form">
                                <form id="#" method="get"  action="#">
                                    <input type="text" name="search" value="" placeholder="Search here..."/>
                                    <button type="submit">
                                        <span><i class="icon-search"></i></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- user-menu -->
                        <div class="ltn__drop-menu">
                            <ul>
                                <li>
                                    <a href="#"><i class="icon-user"></i></a>
                                    <ul>

                                        <!-- quest zwraca true jeśli użytkownaik nie zalogowany,false wykonuje else -->
                                        @guest

                                            @if (Route::has('login'))
                                                <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                                            @endif
                                            @if (Route::has('register'))
                                                <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                                            @endif

                                        @else
                                            <li class="ltn__secondary-color">{{ Auth::user()->name }}</li>
                                            <li>

                                                <a href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a></li>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>


                                        @endguest
                                        @auth
                                        <li><a href="{{ route('cart.index') }}">{{ __('Koszyk') }}</a></li>
                                        @endauth

                                        <li><a href="{{ route('product.create') }}">{{ __('Dodaj produkt') }}</a></li>
                                        <li><a href="{{ route('category.index') }}">{{ __('Wyświetl kategorie') }}</a></li>
                                        <li><a href="{{ route('category.create') }}">{{ __('Dodaj kategorie') }}</a></li>

                                        <li><a href="{{ route('producer.index') }}">{{ __('Wyświetl producentów') }}</a></li>
                                        <li><a href="{{ route('producer.create') }}">{{ __('Dodaj producenta') }}</a></li>



                                        @auth
                                        <li><a href="{{ route('product.index') }}">{{ __('Wyświetl produkty') }}</a></li>
                                        @endauth
                                        @auth
                                        <li><a href="{{ route('account.index') }}">{{ __('My Account') }}</a></li>
                                        @endauth
                                        <li><a href="wishlist.html">Wishlist</a></li>


                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!-- mini-cart -->

                        <div class="mini-cart-icon">
                            <a href="#ltn__utilize-cart-menu" class="ltn__utilize-toggle">
                                <i class="icon-shopping-cart"></i>
                                    <sup class="cart-count"></sup>

                            </a>
                        </div>


                        <!-- mini-cart -->
                        <!-- Mobile Menu Button -->
                        <div class="mobile-menu-toggle d-xl-none">
                            <a href="#ltn__utilize-mobile-menu" class="ltn__utilize-toggle">
                                <svg viewBox="0 0 800 600">
                                    <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top"></path>
                                    <path d="M300,320 L540,320" id="middle"></path>
                                    <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                                </svg>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

            <!-- ltn__header-middle-area end -->
    </header>
    <!-- HEADER AREA END -->

    @yield('content')



    <!-- Utilize Cart Menu Start -->
    <div id="ltn__utilize-cart-menu" class="ltn__utilize ltn__utilize-cart-menu">
        <div class="ltn__utilize-menu-inner ltn__scrollbar">
            <div class="ltn__utilize-menu-head">
                <span class="ltn__utilize-menu-title">Cart</span>
                <button class="ltn__utilize-close">×</button>
            </div>
            <div id="refresh">
                <div class="mini-cart-product-area ltn__scrollbar ">
                    @if(isset($cart) && isset($items))
                        @foreach($items as $item)
                            <div class="mini-cart-item clearfix delete_mem{{$item->PRODUCTS_id}}">
                                <div class="mini-cart-img">
                                    <a href="product-details.html"><img src="{{asset('storage/' . $item->product->image->name)}}" alt="Zdjęcie"></a>
                                    <span class="mini-cart-item-delete delete" data-id="{{$item->PRODUCTS_id}}"><i class="icon-cancel"></i></span>
                                </div>
                                <div class="mini-cart-info">
                                    <h6><a href="#">{{$item->product->name}}</a></h6>
                                    <span class="mini-cart-quantity">{{$item->quantity}} x ${{$item->product->price}}</span>
                                </div>
                            </div>






                    @endforeach
                    @endif


                </div>
                @if(isset($cart) && $cart->total!=0)
                <div class="mini-cart-footer">

                    <div class="mini-cart-sub-total">
                        <h5>Total: <span>$

                            {{$cart->total}}</span></h5>

                    </div>

                    <div class="btn-wrapper">
                        <a href="{{ route('cart.index') }}" class="theme-btn-1 btn btn-effect-1">View Cart</a>
                        @if($cart->mode!='shopping_list')
                        <a href="{{ route('checkout.index') }}" class="theme-btn-2 btn btn-effect-2">Checkout</a>
                        @endif
                    </div>
                    @if($cart->mode=='normal')
                    <div class="btn-wrapper">
                         <a href="{{ route('shoppingList.save', $cart->id) }}" class="theme-btn-2 btn btn-effect-2">{{ __('Zapisz jako nową listę zakupów') }}</a>
                    </div>
                    @endif
                    <br>
                    @if($cart->mode=='shopping_list')
                    <div class="btn-wrapper">
                        <a href="{{ route('shoppingList.save', $cart->id) }}" class="theme-btn-2 btn btn-effect-2">{{ __('Zakończ edycje listy zakupów') }}</a>
                    </div>
                    @endif
                    <p>Free Shipping on All Orders Over $100!</p>
                    @endif
                </div>

            </div>
        </div>


    </div>
    <!-- Utilize Cart Menu End -->

    <!-- Utilize Mobile Menu Start -->
    <!-- Utilize Mobile Menu End -->

    <!-- FOOTER AREA START -->
    <footer class="ltn__footer-area  ">
        <div class="footer-top-area  section-bg-2 plr--5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-sm-6 col-12">
                        <div class="footer-widget footer-about-widget">
                            <div class="footer-logo">
                                <div class="site-logo">
                                    <img src="{{asset('img/logo-2.png')}}" alt="Logo">
Z
                                </div>
                            </div>
                            <p>Lorem Ipsum is simply dummy text of the and typesetting industry. Lorem Ipsum is dummy text of the printing.</p>
                            <div class="footer-address">
                                <ul>
                                    <li>
                                        <div class="footer-address-icon">
                                            <i class="icon-placeholder"></i>
                                        </div>
                                        <div class="footer-address-info">
                                            <p>Brooklyn, New York, United States</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="footer-address-icon">
                                            <i class="icon-call"></i>
                                        </div>
                                        <div class="footer-address-info">
                                            <p><a >+0123-456789</a></p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="footer-address-icon">
                                            <i class="icon-mail"></i>
                                        </div>
                                        <div class="footer-address-info">
                                            <p><a >example@example.com</a></p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="ltn__social-media mt-20">
                                <ul>
                                    <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                                    <li><a href="#" title="Youtube"><i class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                        <div class="footer-widget footer-menu-widget clearfix">
                            <h4 class="footer-title">Company</h4>
                            <div class="footer-menu">
                                <ul>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                        <div class="footer-widget footer-menu-widget clearfix">
                            <h4 class="footer-title">Services.</h4>
                            <div class="footer-menu">
                                <ul>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                        <div class="footer-widget footer-menu-widget clearfix">
                            <h4 class="footer-title">Customer Care</h4>
                            <div class="footer-menu">
                                <ul>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-sm-12 col-12">
                        <div class="footer-widget footer-newsletter-widget">
                            <h4 class="footer-title">Newsletter</h4>
                            <p>Subscribe to our weekly Newsletter and receive updates via email.</p>
                            <div class="footer-newsletter">
                                <div id="mc_embed_signup">
                                    <form action="https://gmail.us5.list-manage.com/subscribe/post?u=dde0a42ff09e8d43cad40dc82&amp;id=72d274d15d" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                        <div id="mc_embed_signup_scroll">
                                            <div class="mc-field-group">
                                                <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Email*">
                                            </div>
                                            <div id="mce-responses" class="clear">
                                                <div class="response" id="mce-error-response" style="display:none"></div>
                                                <div class="response" id="mce-success-response" style="display:none"></div>
                                            </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_dde0a42ff09e8d43cad40dc82_72d274d15d" tabindex="-1" value=""></div>
                                            <div class="clear">
                                                <div class="btn-wrapper">
                                                    <button class="theme-btn-1 btn"  type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe"><i class="fas fa-location-arrow"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <h5 class="mt-30">We Accept</h5>
                            <img src="{{asset('img/icons/payment-4.png')}}" alt="Payment Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ltn__copyright-area ltn__copyright-2 section-bg-2 ltn__border-top-2 plr--5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="ltn__copyright-design clearfix">
                            <p>All Rights Reserved @ Company <span class="current-year"></span></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 align-self-center">
                        <div class="ltn__copyright-menu text-right text-end">
                            <ul>
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="#">Claim</a></li>
                                <li><a href="#">Privacy & Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- FOOTER AREA END -->

</div>
<!-- Body main wrapper end -->

<!-- preloader area start -->
<div class="preloader d-none" id="preloader">
    <div class="preloader-inner">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>
</div>
<!-- preloader area end -->





<script type="text/javascript">
    const deleteUrl = "{{url('cart')}}/";
    const deleteConfirm = "{{ __('shop.messages.delete_confirm') }}";
    @yield('javascript')

</script>
@yield('js-files')
<script src="{{ asset('js/delete.js') }}"></script>
</body>
</html>
