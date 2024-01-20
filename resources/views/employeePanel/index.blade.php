@extends('layouts.appwhite')

@section('content')

    <body>


    <!-- Add your site or application content here -->

    <!-- Body main wrapper start -->
    <div class="body-wrapper">
        @include('helpers.responses')


        <!-- BREADCRUMB AREA START -->
        <div
            class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image"
            data-bg="img/bg_used/8.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                            <div class="section-title-area ltn__section-title-2">
                                <h6 class="section-subtitle ltn__secondary-color">// Witamy w naszym sklepie</h6>
                                <h1 class="section-title white-color">Panel pracownika</h1>
                            </div>
                            <div class="ltn__breadcrumb-list">
                                <ul>
                                    <li><a href="index.html">Start</a></li>
                                    <li>Panel pracownika</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BREADCRUMB AREA END -->

        <!-- WISHLIST AREA START -->
        <div class="liton__wishlist-area pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- PRODUCT TAB AREA START -->
                        <div class="ltn__product-tab-area">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="ltn__tab-menu-list mb-50">
                                            <div class="nav">
                                                <a class="active show" data-bs-toggle="tab" href="#liton_tab_1_1">Dashboard
                                                    <i class="fas fa-home"></i></a>
                                                <a href="{{ url(route('user.index')) }}">Użytkownicy <i class="fas fa-file-alt"></i></a>
                                                <a href="{{ url(route('order.index')) }}">Zamówienia <i class="fas fa-file-alt"></i></a>
                                                <a href="{{ url(route('shoppingList.index')) }}">Listy zakupów <i class="fas fa-file-alt"></i></a>
                                                <a href="{{ url(route('product.index')) }}">Produkty <i class="fas fa-file-alt"></i></a>
                                                <a href="{{ url(route('producer.index')) }}">Producenci <i class="fas fa-file-alt"></i></a>
                                                <a href="{{ url(route('category.index')) }}">Kategorie <i class="fas fa-file-alt"></i></a>




                                                    <a href="{{ route('logout') }}"
                                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                        {{ __('Logout') }}
                                                    </a>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="liton_tab_1_1">
                                                <div class="ltn__myaccount-tab-content-inner">
                                                    <p>Witaj <strong>
                                                            {{ Auth::user()->name }}
                                                        </strong> (To nie twoje konto <strong>{{ Auth::user()->name }}
                                                        </strong>?
                                                        <small><a href="{{ route('logout') }}">Wyloguj się</a></small> )</p>
                                                    <p>Panel pracownika umożliwia dostęp do
                                                        <span>zamówień</span>,  <span>użytkowników</span>, <span>list zakupów</span>, <span>produktów</span>,
                                                        <span>producentów</span>, <span>kategori</span>
                                                        .</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- PRODUCT TAB AREA END -->
                    </div>
                </div>
            </div>
        </div>
        <!-- WISHLIST AREA START -->



    </div>
    <!-- Body main wrapper end -->

    <!-- Javascript Requirements -->
    <!-- Laravel Javascript Validation -->

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\StoreAddressRequest') !!}
    </body>



@endsection

@section('javascript')
    const DATA = {
    editfieldUrl: '{{url('cart')}}/',
    selectAddressUrl: '{{url('address/select')}}/',
    storeAddressUrl: '{{url('address/store')}}',
    deleteAddressUrl: '{{url('address')}}/',
    }
@endsection
