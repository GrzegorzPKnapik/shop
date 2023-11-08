@extends('layouts.appwhite')

@section('content')

    <body>


    <!-- Add your site or application content here -->

    <!-- Body main wrapper start -->
    <div class="body-wrapper">

        <!-- BREADCRUMB AREA START -->
        <div
            class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image"
            data-bg="{{asset('img/bg/9.jpg')}}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                            <div class="section-title-area ltn__section-title-2">
                                <h6 class="section-subtitle ltn__secondary-color">// Welcome to our company</h6>
                                <h1 class="section-title white-color">Shopping list preview</h1>
                            </div>
                            <div class="ltn__breadcrumb-list">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li>Shopping list</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


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
                                                <a class="active show" data-bs-toggle="tab">Shopping list<i
                                                        class="fas fa-file-alt"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <div class="tab-content">

                                            <div class="ltn__myaccount-tab-content-inner">
                                                <p>Lista zakupów</p>
                                                <div class="ltn__form-box">
                                                    <div class="ltn__myaccount-tab-content-inner">
                                                        <div class="table-responsive">

                                                            @foreach($shopping_list as $item)
                                                                <p class="text-center">
                                                                    <label>Shopping List ID:</label>
                                                                <h1 class="text-center">#{{$item->id}}</h1>
                                                                 </p>

                                                                @foreach ($item->orders as $index => $item)
                                                                    <p class="text-center">
                                                                        <label>Order ID:</label>
                                                                    <h1 class="text-center">#{{$item->id}}</h1>
                                                                    </p>
                                                                    <br>

                                                                <td>Address:</td>
                                                                <p><strong>{{$item->address->name}} {{{$item->address->surname}}}</strong></p>
                                                                <p>{{$item->address->city}}, {{$item->address->street}}<br>
                                                                    {{$item->address->zip_code}}, {{$item->address->voivodeship}}</p>
                                                                <p>Telefon: {{$item->address->phone_number}}</p>
                                                                @php break;@endphp
                                                                @endforeach
                                                            @endforeach

                                                                <div id="refreshAddress">
                                                                    <p>
                                                                    <h4><small><a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                                Wybierz inny adres
                                                                            </a></small></h4>
                                                                    </p>
                                                                    <div class="collapse" id="collapseExample">
                                                                        <div class="card card-body">
                                                                            @foreach($addresses as $address)
                                                                                @if($address->selected != true)
                                                                                    <div class="form-check selectAddress" data-id="{{$address->id}}">
                                                                                        <input class="form-check-input" type="radio" name="selected" id="flexRadioDefault2">
                                                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                                                            Wybrany jako główny
                                                                                        </label>
                                                                                    </div>

                                                                                    <address>
                                                                                        <p><strong>{{$address->name}} {{{$address->surname}}}</strong></p>
                                                                                        <p>{{$address->city}}, {{$address->street}}<br>
                                                                                            {{$address->zip_code}}, {{$address->voivodeship}}</p>
                                                                                        <p>Telefon: {{$address->phone_number}}</p>
                                                                                        _____________________________
                                                                                    </address>
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </div>


                                                                    <h4>Adres dostawy: </h4>
                                                                    @foreach($addresses as $address)
                                                                        @if($address->selected == true)
                                                                            <div class="form-check">
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

                                                                                <hr style="width: 20%; border-top: 3px solid black; background-color: black;">

                                                                            </address>
                                                                        @endif
                                                                    @endforeach
                                                                </div>

                                                                <h4><small><a data-bs-target="#quick_view_modal" href="#" data-bs-toggle="modal" role="button" title="Quick View">
                                                                            Wpisz adres dostawy
                                                                        </a></small></h4>

                                                            <br>

                                                            <table class="table text-center caption-top table-sm">
                                                                <caption>Products</caption>
                                                                <thead>
                                                                <tr>
                                                                    <th>Number</th>
                                                                    <th>Image</th>
                                                                    <th>Name</th>
                                                                    <th>Price</th>
                                                                    <th>Quantity</th>
                                                                    <th>SubTotal</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($shopping_list as $index => $item)
                                                                    @foreach ($item->shopping_lists_products as $index => $item)
                                                                        <tr>
                                                                            <td class="cart-product-name">{{ $index+1}}.</td>
                                                                            <td class="cart-product-image"> <a href="product-details.html"><img src="{{asset('storage/' . $item->product->image->name)}}" alt="Zdjęcie"></a></td>
                                                                            <td class="cart-product-name">{{$item->product->name}}</td>
                                                                            <td class="cart-product-name">${{$item->product->price}}</td>
                                                                            <td class="cart-product-name">x{{$item->quantity}}</td>
                                                                            <td class="cart-product-subtotal">${{$item->sub_total}}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endforeach
                                                                </tbody>
                                                            </table>







                                                                <h4 class="pt-4 pb-2">Cykliczne dostawy:</h4>
                                                                <div id="refreshShoppingList">
                                                                <p>


                                                                    @foreach($shopping_list as $item)
                                                                            @if($item->delivery_date == null)
                                                                                <label>Brak dodanej daty dostawy </label>
                                                                            @else
                                                                                <label>Ustawiony dzień realizacji cyklicznych dostaw:
                                                                                    {{ \Carbon\Carbon::parse($item->delivery_date)->locale('pl')->isoFormat('dddd') }}
                                                                                </label>
                                                                            <br>
                                                                            <label>Najbliższa data cyklicznej dostawy:
                                                                                {{ date('Y-m-d', strtotime($item->delivery_date)) }}
                                                                            </label>
                                                                            <br>
                                                                            <label>Data ostatniej możliwej edycji listy w przypadku złożenia zamówinia:
                                                                                {{ date('Y-m-d', strtotime($item->mod_available_date)) }}
                                                                            </label>

                                                                            @endif

                                                                    @endforeach
                                                                    <br>
                                                                </p>
                                                                            @if($item->delivery_date == null)
                                                                        <h4><small><a data-toggle="collapse" href="#collapseDayPicker" role="button" aria-expanded="false" aria-controls="collapseDayPicker">
                                                                                    Dodaj dzień dostawy
                                                                                </a></small></h4>
                                                                        </p>
                                                                            @else
                                                                        <h4><small><a data-toggle="collapse" href="#collapseDayPicker" role="button" aria-expanded="false" aria-controls="collapseDayPicker">
                                                                                    Zmień dzień dostawy
                                                                                </a></small></h4>
                                                                        </p>
                                                                            @endif

                                                                        </a></small></h4>
                                                                </div>


                                                                <div class="collapse" id="collapseDayPicker">
                                                                    <div class="card card-body">
                                                                        <form class="custom-form selectDay" method="POST">
                                                                            @csrf
                                                                            <div class="col-md-6">
                                                                                <div class="input-item">
                                                                                    <label>Dzień cyklicznych dostaw:</label>
                                                                                    <select name="select" class="nice-select">
                                                                                        <option value="0"> Wybierz dzień</option>
                                                                                        @foreach($collectionDates as $date)
                                                                                            <option value={{$date['date']}}> {{$date['name']}} (dostawa:   {{ $date['date'] }} )
                                                                                                @endforeach
                                                                                            </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                        <div id="refreshDayDelete">
                                                                        @if($item->delivery_date != null)
                                                                        <h4><small><a href="" class="deleteDay" data-id="{{$item->id}}"> Usuń adres</a></small>
                                                                            @endif
                                                                         </div>
                                                                        <br>
                                                                    </div>
                                                                </div>

                                                                <h4 class="pt-4 pb-2">Status:</h4>
                                                                <br>

                                                            <div class="shoping-cart-total mt-50">
                                                                <h4>Cart Totals</h4>
                                                                <table class="table text-center table-sm">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td>Vat</td>
                                                                        <td>$00.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Order Total</strong></td>
                                                                        <td><strong>$
                                                                                @foreach($shopping_list as $item)
                                                                                    {{$item->total}}
                                                                                    @php break;@endphp
                                                                                @endforeach
                                                                            </strong></td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                                <button class="theme-btn-1 btn btn-effect-1 saveDay" data-id="{{$item->id}}" type="submit">
                                                                    {{ __('Save changes') }}
                                                                </button>

                                                                <div id="refreshActive">
                                                                <div class="btn-wrapper">
                                                                        <button class="theme-btn-1 btn btn-effect-1 storeOrderSL" data-id="{{$item->id}}" type="submit">
                                                                        @if($item->active == false)
                                                                            {{
                                                                                __('Aktywuj')
                                                                            }}
                                                                        @else
                                                                            {{
                                                                            __('Dezaktywuj')
                                                                       }}
                                                                        @endif
                                                                        </button>
                                                                </div>
                                                                </div>




                                                        </div>

                                                        moźliwość nanoszenia zmian i pracowania z lsitą zakupów
                                                        <div class="btn-wrapper">
                                                            <a href="{{ route('shoppingList.upload', $item->id) }}" class="theme-btn-2 btn btn-effect-2">{{ __('Załaduj listę zakupów do dalszej edycji') }}</a>
                                                        </div>

                                                        <br>
                                                        tylko kopiuje produkty do koszyka i pracujemy jakby nie istniała lista zakupów, tworzy nowy koszyk w bazie
                                                        <div class="btn-wrapper">
                                                            <a href="{{ route('shoppingList.copyToCart', $item->id) }}" class="theme-btn-2 btn btn-effect-2">{{ __('Skopiuj zawartość listy zakupów do koszyka') }}</a>
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
                    <!-- PRODUCT TAB AREA END -->
                </div>
            </div>
        </div>
    </div>

    </div>



    <div class="ltn__modal-area ltn__quick-view-modal-area">
        <div class="modal fade" id="quick_view_modal" tabindex="-1">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" id="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <!-- <i class="fas fa-times"></i> -->
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="ltn__quick-view-modal-inner">
                            <div class="modal-product-item">
                                <div class="row">
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
                                                            class="btn theme-btn-1 btn-effect-1 text-uppercase save-address" >
                                                        {{__('Zapisz adres')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
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


    </body>

@endsection

@section('javascript')
    const DATA = {
    saveDayUrl: '{{url('/shopping_list/save_day')}}/',
    deleteDayUrl: '{{url('/shopping_list/delete_day')}}/',
    selectAddressUrl: '{{url('address/select')}}/',
    storeAddressUrl: '{{url('address/store')}}',
    storeOrderSLUrl: '{{url('/order/storeSL')}}/',
    }
@endsection
