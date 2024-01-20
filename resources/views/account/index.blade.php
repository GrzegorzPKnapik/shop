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
                                <h6 class="section-subtitle ltn__secondary-color"></h6>
                                <h1 class="section-title white-color">Konto</h1>
                            </div>
                            <div class="ltn__breadcrumb-list">
                                <ul>
                                    <li><a href="index.html">Start</a></li>
                                    <li>Konto</li>
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
                                                @can('isUser')
                                                    <a data-bs-toggle="tab" href="#liton_tab_1_2">Zamówienia <i
                                                            class="fas fa-file-alt"></i></a>
                                                    <a data-bs-toggle="tab" href="#liton_tab_1_7">Listy zakupów<i
                                                            class="fas fa-file-alt"></i></a>
                                                @endcan
                                                <a data-bs-toggle="tab" href="#liton_tab_1_4">Adresy <i
                                                        class="fas fa-map-marker-alt"></i></a>
                                                <a data-bs-toggle="tab" href="#liton_tab_1_5">Szczegóły konta <i
                                                        class="fas fa-user"></i></a>
                                                <a data-bs-toggle="tab" href="#liton_tab_1_6">Utwórz nowy adres <i
                                                        class="fas fa-map-marker-alt"></i></a>
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
                                                    <p>Pulpit konta umożliwia dostęp do
                                                        <span>ostatnich zamówień</span>,  <span>szczegółów konta</span>, <span>zarządanie listami zakupów</span>, zarządanie <span>adresami</span>
                                                        .</p>
                                                </div>
                                            </div>

                                            @can('isUser')
                                                <div class="tab-pane fade" id="liton_tab_1_7">
                                                    <div class="ltn__myaccount-tab-content-inner">
                                                        <p>Listy zakupów. Mozliwość włączenia cyklicznych dostaw oraz przechowywania zapisanych koszyków.</p>
                                                        <div class="table-responsive">
                                                            <table class="table text-center table-sm">
                                                                <thead>
                                                                <tr>
                                                                    <th>Tytuł</th>
                                                                    <th>Data ostatniej aktualizacji</th>
                                                                    <th>Cena</th>
                                                                    <th>Aktywna</th>
                                                                    <th>Akcje</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                <!--                                                            //wyswietl tylko te co mają status różny od ordered czyli od resume-->
                                                                @foreach($shopping_lists as $item)


                                                                    <tr>
                                                                        <td class="cart-product-name">{{$item->title}}</td>


                                                                        <!--                                                                        <td class="cart-product-name">#{{$item->id}}</td>-->
                                                                        <td class="cart-product-name">{{$item->updated_at}}</td>

                                                                        <td class="cart-product-name">{{ number_format($item->total, 2, ',', ' ') }} zł</td>
                                                                        <td class="cart-product-name">
                                                                            @if($item->active==true)
                                                                                {{__('TAK')}}
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            <a href="{{ route('shoppingList.show', $item->id) }}">
                                                                                <button class="icon-search"></button>
                                                                            </a>
                                                                        </td>

                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="liton_tab_1_2">
                                                    <div class="ltn__myaccount-tab-content-inner">
                                                        <div class="table-responsive">
                                                            <table class="table text-center table-sm">
                                                                <thead>
                                                                <tr>
                                                                    <th>Numer</th>
                                                                    <th>Data złożenia zamówienia</th>
                                                                    <th>Cena</th>
                                                                    <th>Akcje</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($orders as $item)
                                                                    <tr>

                                                                        <td class="cart-product-name">#{{$item->id}}</td>
                                                                        <td class="cart-product-name">{{$item->created_at}}</td>

                                                                        <td class="cart-product-name">{{ number_format($item->shopping_list->total, 2, ',', ' ') }} zł</td>
                                                                        <td>
                                                                            <a href="{{ route('order.show', $item->id) }}">
                                                                                <button class="icon-search"></button>
                                                                            </a>
                                                                        </td>

                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endcan

                                            <div class="tab-pane fade" id="liton_tab_1_4">
                                                <div class="ltn__myaccount-tab-content-inner">
                                                    <div id="refreshAddress">
                                                        <p>Zapisane adresy
                                                        </p>
                                                        <div class="row">
                                                            <div class="col-md-6 col-12 learts-mb-30">
                                                                <h4>Adres dostawy: <small></small></h4>

                                                                @can('isUser')
                                                                    @foreach($addresses as $address)
                                                                        <h4><small><a href="{{ route('address.edit', $address->id) }}"> edit</a></small>
                                                                            <button class="icon-cancel deleteAddress" data-id="{{$address->id}}"></button></h4>
                                                                        <div class="form-check selectAddress" data-id="{{$address->id}}">
                                                                            <input class="form-check-input" type="radio" name="selected" id="flexRadioDefault2"
                                                                                   @if($address->selected == true)
                                                                                       checked
                                                                                @endif

                                                                            >

                                                                            <label class="form-check-label" for="flexRadioDefault2">
                                                                                Wybrany jako główny
                                                                            </label>
                                                                        </div>

                                                                        <address>
                                                                            <p><strong>{{$address->name}} {{{$address->surname}}}</strong></p>
                                                                            <p>{{$address->city}}, {{$address->street}}<br>
                                                                                {{$address->zip_code}}, {{$address->voivodeship}}</p>
                                                                            <p>Telefon: {{$address->phone_number}}</p>
                                                                            <hr style="width: 60%; border-top: 3px solid black; background-color: black;">
                                                                        </address>
                                                                    @endforeach
                                                                @endcan


                                                                @can('isEmployee')
                                                                    @foreach($addresses as $address)
                                                                        @if($address->selected == true)
                                                                            <h4><small><a href="{{ route('address.edit', $address->id) }}"> edit</a></small>
                                                                                <button class="icon-cancel deleteAddress" data-id="{{$address->id}}"></button></h4>
                                                                            <div class="form-check selectAddress" data-id="{{$address->id}}">
                                                                                <input class="form-check-input" type="radio" name="selected" id="flexRadioDefault2"
                                                                                       @if($address->selected == true)
                                                                                           checked
                                                                                    @endif

                                                                                >

                                                                                <label class="form-check-label" for="flexRadioDefault2">
                                                                                    Wybrany jako główny
                                                                                </label>
                                                                            </div>

                                                                            <address>
                                                                                <p><strong>{{$address->name}} {{{$address->surname}}}</strong></p>
                                                                                <p>{{$address->city}}, {{$address->street}}<br>
                                                                                    {{$address->zip_code}}, {{$address->voivodeship}}</p>
                                                                                <p>Telefon: {{$address->phone_number}}</p>
                                                                                <hr style="width: 60%; border-top: 3px solid black; background-color: black;">
                                                                            </address>
                                                                        @endif
                                                                    @endforeach
                                                                @endcan
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="liton_tab_1_6">
                                                <div class="ltn__myaccount-tab-content-inner">

                                                    <div class="ltn__form-box">



                                                        <form class="addAddress" id="address" method="POST">
                                                            <div id="refreshForm">
                                                                @csrf
                                                                <div class="row mb-50">
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label>Imie:</label>
                                                                            <input id="name" type="text" placeholder="Imie"
                                                                                   class="form-control @error('name') is-invalid @enderror"
                                                                                   name="name"
                                                                                   required autocomplete="name" autofocus>
                                                                            @error('name')
                                                                            <span class="invalid-feedback" role="alert">
                                                                          <strong>{{$message }}</strong>
                                                                             </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label>Nazwisko:</label>
                                                                            <input id="surname" type="text" placeholder="Nazwisko"
                                                                                   class="form-control @error('surname') is-invalid @enderror"
                                                                                   name="surname"
                                                                                   required autocomplete="surname" autofocus>
                                                                            @error('surname')
                                                                            <span class="invalid-feedback" role="alert">
                                                                          <strong>{{$message }}</strong>
                                                                             </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label>Miasto:</label>
                                                                            <input id="city" type="text" placeholder="Miasto"
                                                                                   class="form-control @error('city') is-invalid @enderror"
                                                                                   name="city" value="{{ old('city') }}"
                                                                                   required autocomplete="city" autofocus>
                                                                            @error('city')
                                                                            <span class="invalid-feedback" role="alert">
                                                                          <strong>{{$message }}</strong>
                                                                             </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">

                                                                        <div class="mb-3">
                                                                            <label>Ulica:</label>
                                                                            <input id="street" type="text" placeholder="Ulica"
                                                                                   class="form-control @error('street') is-invalid @enderror"
                                                                                   name="street" value="{{ old('street') }}"
                                                                                   required autocomplete="street" autofocus>
                                                                            @error('street')
                                                                            <span class="invalid-feedback" role="alert">
                                                                          <strong>{{$message }}</strong>
                                                                             </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">

                                                                        <div class="mb-3">
                                                                            <label>Kod pocztowy:</label>
                                                                            <input id="zip_code" type="text" placeholder="Kod pocztowy"
                                                                                   class="form-control @error('zip_code') is-invalid @enderror"
                                                                                   name="zip_code" value="{{ old('zip_code') }}"
                                                                                   required autocomplete="zip_code" autofocus>
                                                                            @error('zip_code')
                                                                            <span class="invalid-feedback" role="alert">
                                                                          <strong>{{$message }}</strong>
                                                                             </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">

                                                                        <div class="mb-3">
                                                                            <label>Województwo:</label>
                                                                            <input id="voivodeship" type="text" placeholder="Województwo"
                                                                                   class="form-control @error('voivodeship') is-invalid @enderror"
                                                                                   name="voivodeship" value="{{ old('voivodeship') }}"
                                                                                   required autocomplete="voivodeship" autofocus>
                                                                            @error('voivodeship')
                                                                            <span class="invalid-feedback" role="alert">
                                                                          <strong>{{$message }}</strong>
                                                                             </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">

                                                                        <div class="mb-3">
                                                                            <label>Numer telefonu:</label>
                                                                            <input id="phone_number" type="text" placeholder="Numer telefonu"
                                                                                   class="form-control @error('phone_number') is-invalid @enderror"
                                                                                   name="phone_number" value="{{ old('phone_number') }}"
                                                                                   required autocomplete="phone_number" autofocus>
                                                                            @error('phone_number')
                                                                            <span class="invalid-feedback" role="alert">
                                                                          <strong>{{$message }}</strong>
                                                                             </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="btn-wrapper">
                                                                    <button type="submit"
                                                                            class="btn theme-btn-1 btn-effect-1 text-uppercase save-address">
                                                                        {{__('Zapisz adres')}}
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="liton_tab_1_5">
                                                <div class="ltn__myaccount-tab-content-inner">
                                                    <div class="ltn__form-box">
                                                        <div class="row mb-50">
                                                            <div class="col-md-6">
                                                                <label>Imie:</label>
                                                                <input type="text" value="{{ Auth::user()->name }}" name="ltn__lastname"
                                                                       readonly>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Nazwisko:</label>
                                                                <input type="text" value="{{ Auth::user()->surname }}" name="ltn__lastname"
                                                                       readonly>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Email:</label>
                                                                <input type="email" value="{{ Auth::user()->email }}" name="ltn__lastname"
                                                                       readonly>
                                                            </div>
                                                            @can('isEmployee')
                                                                <div class="col-md-6">
                                                                    <label>Pesel:</label>
                                                                    <input type="text" value="{{ Auth::user()->pesel }}" name="ltn__lastname"
                                                                           readonly>
                                                                </div>
                                                            @endcan



                                                        </div>

                                                    </div>
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

        <div class="ltn__feature-area before-bg-bottom-2-- mb--30--- plr--5 mb-120">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__feature-item-box-wrap ltn__border-between-column white-bg">
                            <div class="row">
                                <div class="col-xl-3 col-md-6 col-12">
                                    <div class="ltn__feature-item ltn__feature-item-8">
                                        <div class="ltn__feature-icon">
                                            <img src="img/icons/icon-img/11.png" alt="#">
                                        </div>
                                        <div class="ltn__feature-info">
                                            <h4>Starannie Wyselekcjonowane Produkty Spożywcze</h4>
                                            <p>Zapewniamy starannie wyselekcjonowane produkty spożywcze</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 col-12">
                                    <div class="ltn__feature-item ltn__feature-item-8">
                                        <div class="ltn__feature-icon">
                                            <img src="img/icons/icon-img/12.png" alt="#">
                                        </div>
                                        <div class="ltn__feature-info">
                                            <h4>Działamy lokalnie</h4>
                                            <p>W obrębie 20km od centrum Katowic</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 col-12">
                                    <div class="ltn__feature-item ltn__feature-item-8">
                                        <div class="ltn__feature-icon">
                                            <img src="img/icons/icon-img/13.png" alt="#">
                                        </div>
                                        <div class="ltn__feature-info">
                                            <h4>Lista zakupów</h4>
                                            <p>Możliwość tworzenia list zakupów</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6 col-12">
                                    <div class="ltn__feature-item ltn__feature-item-8">
                                        <div class="ltn__feature-icon">
                                            <img src="img/icons/icon-img/14.png" alt="#">
                                        </div>
                                        <div class="ltn__feature-info">
                                            <h4>Darmowa dostawa</h4>
                                            <p>Oferujemy darmową dostawę czyklicznych zakupów</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
