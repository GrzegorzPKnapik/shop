@extends('layouts.appwhite')

@section('content')
    <style>
        /* Dostosuj rozmiar etykiety */
        .btn-outline-secondary {
            font-size: 0.8rem; /* Dostosuj wielkość czcionki według własnych preferencji */
            padding: 0.2rem 0.5rem; /* Dostosuj wypełnienie według własnych preferencji */
        }

        .disabled-link {
            color: #999; /* Ustaw kolor na szary lub inny kolor sugerujący nieaktywność */
            pointer-events: none; /* Wyłącz interakcję z linkiem */
        }

        .disabled-icon {
            opacity: 0.5;
        }

        @import url(https://fonts.googleapis.com/css?family=Roboto);
        @import url(https://fonts.googleapis.com/css?family=Handlee);


        .paper {
            position: relative;
            width: 90%;
            max-width: 200px;
            min-width: 328px;
            height: 480px;
            margin-right: auto;
            background: #fafafa;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,.3);
            overflow: hidden;
        }
        .paper:before {
            content: '';
            position: absolute;
            top: 0; bottom: 0; left: 0;
            width: 60px;
            background: radial-gradient(#b7b6b1 6px, transparent 7px) repeat-y;
            background-size: 30px 30px;
            border-right: 3px solid #f1a1a6;
            box-sizing: border-box;
        }

        .paper-content {
            position: absolute;
            top: 30px; right: 0; bottom: 30px; left: 60px;
            background: linear-gradient(transparent, transparent 28px, #91D1D3 28px);
            background-size: 30px 30px;
        }

        .paper-content textarea {
            width: 100%;
            max-width: 100%;
            height: 100%;
            max-height: 100%;
            line-height: 30px;
            padding: 0 10px;
            border: 0;
            outline: 0;
            background: transparent;
            color: #69a3fc;
            font-family: 'Handlee', cursive;
            font-weight: bold;
            font-size: 15px;
            box-sizing: border-box;
            z-index: 1;
        }

        .note-label {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            font-size: 18px;
            font-weight: bold;
            color: #575450;
        }

    </style>
    <body>


    <!-- Add your site or application content here -->

    <!-- Body main wrapper start -->
    <div class="body-wrapper">

        <!-- BREADCRUMB AREA START -->
        <div
            class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image"
            data-bg="{{asset('img/bg_used/10.jpg')}}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                            <div class="section-title-area ltn__section-title-2">
                                <h6 class="section-subtitle ltn__secondary-color"></h6>
                                <h1 class="section-title white-color">Podgląd listy zakupów</h1>
                            </div>
                            <div class="ltn__breadcrumb-list">
                                <ul>
                                    <li><a href="index.html">Start</a></li>
                                    <li>Podgląd listy zakupów</li>
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
                                                <a class="active show" data-bs-toggle="tab">Lista zakupów<i
                                                        class="fas fa-file-alt"></i></a>
                                            </div>
                                            <div class="mb-lg-3"></div>
                                            <div class="paper">
                                                <div class="note-label">Notatnik</div>
                                                <div class="paper-content">
                                                    <textarea id="notepadTextarea" data-id="{{$shopping_list->id}}" spellcheck="false" autofocus placeholder="Wpisz swoje notatki odnośnie zakupów">{{$shopping_list->notepad}}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-lg-8">
                                        <div class="tab-content">

                                            <div class="ltn__myaccount-tab-content-inner">
                                                <div style="background-color: #7fb401; font-weight: bold" class="text-center">Tytuł:

                                                    <div id="refreshTitle">

                                                        <h1 class="text-center">{{$shopping_list->title}}
                                                            @if(\PHPUnit\Framework\isNull($shopping_list->orders))
                                                                <span style="font-size: smaller;">
                                                                            <a data-bs-target="#quick_view_edit_title" href="#" data-bs-toggle="modal" role="button" title="Quick View">
                                                                            <button class="icon-edit" style="font-size: 1rem;"></button>
                                                                        </a>
                                                                        </span>
                                                            @endif

                                                        </h1>
                                                    </div>
                                                </div>
                                                <div class="ltn__form-box">
                                                    <div class="ltn__myaccount-tab-content-inner">
                                                        <div class="table-responsive">


                                                            <p class="text-center">
                                                                @forelse($shopping_list->orders as $order)
                                                                    <label>Ostatni numer zamówienia:</label>
                                                            <h1 class="text-center">#{{$order->id}}</h1>
                                                            @empty

                                                            @endforelse
                                                            </p>

                                                            <div id="refreshAssignAddress">

                                                                <h4>Adres dostawy: </h4>

                                                                @if($shopping_list->ADDRESSES_id != null && $shopping_list->address != null)
                                                                    <td>Przypisany adres:</td>
                                                                    <p><strong>{{$shopping_list->address->name}} {{{$shopping_list->address->surname}}}</strong></p>
                                                                    <p>{{$shopping_list->address->city}}, {{$shopping_list->address->street}}<br>
                                                                        {{$shopping_list->address->zip_code}}, {{$shopping_list->address->voivodeship}}</p>
                                                                    <p>Telefon: {{$shopping_list->address->phone_number}}</p>

                                                                @else
                                                                    <td>Adres:</td>
                                                                    Nie przypisano adresu!

                                                                @endif


                                                                <p>
                                                                <h4><small><a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                            Wybierz inny adres
                                                                        </a></small></h4>
                                                                </p>
                                                            </div>
                                                            <div class="collapse" id="collapseExample">
                                                                <div class="card card-body">
                                                                    <form id="assignAddress" data-id="{{$shopping_list->id}}" method="POST">
                                                                        <div id="refreshAddress">
                                                                            @csrf
                                                                            @forelse($addresses as $address)
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="radio" value={{$address->id}} name="selectAddress" id="flexRadioDefault2"
                                                                                           @if($address->selected == true)
                                                                                               checked
                                                                                        @endif
                                                                                    >

                                                                                    @if($address->selected == true)
                                                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                                                            Wybrany jako główny
                                                                                        </label>
                                                                                    @endif

                                                                                </div>

                                                                                <address>
                                                                                    <p><strong>{{$address->name}} {{{$address->surname}}}</strong></p>
                                                                                    <p>{{$address->city}}, {{$address->street}}<br>
                                                                                        {{$address->zip_code}}, {{$address->voivodeship}}</p>
                                                                                    <p>Telefon: {{$address->phone_number}}</p>
                                                                                    _____________________________
                                                                                </address>


                                                                            @empty
                                                                                Brak adresów w książce adresowej
                                                                            @endforelse
                                                                            @if(!$addresses->isEmpty())
                                                                                <button class="theme-btn-1 btn btn-effect-1" type="submit">
                                                                                    {{ __('Zatwierdź') }}
                                                                                </button>
                                                                            @endif
                                                                        </div>

                                                                    </form>
                                                                </div>
                                                            </div>



                                                            <h4><small><a data-bs-target="#quick_view_modal" href="#" data-bs-toggle="modal" role="button" title="Quick View">
                                                                        Wpisz adres dostawy
                                                                    </a></small></h4>

                                                            <br>

                                                            <table class="align-middle table text-center caption-top table-sm">
                                                                <caption>Produkty</caption>
                                                                <thead>
                                                                <tr>
                                                                    <th>Numer</th>
                                                                    <th>Zdjęcie</th>
                                                                    <th>Nazwa</th>
                                                                    <th>Cena</th>
                                                                    <th>Ilość</th>
                                                                    <th>Suma częściowa</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach ($shopping_list->shopping_lists_products as $index => $item)
                                                                    <tr>
                                                                        <td class="cart-product-name">{{ $index+1}}.</td>
                                                                        <td class="cart-product-image">
                                                                            <a href="{{route('shop.product', $item->product->id)}}"><img class="{{!$item->product->status->isEnable() ? 'disabled-icon' : ''}}" src="{{asset('storage/' . $item->product->image->name)}}" alt="Zdjęcie"></a>
                                                                        </td>
                                                                        <td class="cart-product-name">{{$item->product->name}}</td>
                                                                        <td class="cart-product-name">{{ number_format($item->product->price, 2, ',', ' ') }} zł</td>
                                                                        <td class="cart-product-name">x{{$item->quantity}}</td>
                                                                        <td class="cart-product-subtotal">{{ number_format($item->sub_total, 2, ',', ' ') }} zł</td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>




                                                            <h4 class="pt-4 pb-2">Cykliczne dostawy:</h4>
                                                            <div id="refreshShoppingList">
                                                                <p>


                                                                    @if($shopping_list->delivery_date == null)
                                                                        <label>Brak dodanej daty dostawy </label>
                                                                    @else
                                                                        <label>Ustawiony dzień realizacji cyklicznych dostaw:
                                                                            {{ \Carbon\Carbon::parse($shopping_list->delivery_date)->locale('pl')->isoFormat('dddd') }}
                                                                        </label>
                                                                        <br>
                                                                        <label>Najbliższa data cyklicznej dostawy:
                                                                            {{ date('Y-m-d', strtotime($shopping_list->delivery_date)) }}
                                                                        </label>
                                                                        <br>
                                                                        <label>Data ostatniej możliwej edycji listy w przypadku złożenia zamówinia:
                                                                            {{ date('Y-m-d', strtotime($shopping_list->mod_available_date)) }}
                                                                        </label>

                                                                    @endif

                                                                    <br>
                                                                </p>
                                                                @if($shopping_list->delivery_date == null)
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
                                                                                    @foreach($collectionDates as $date)
                                                                                        <option value={{$date['date']}}> {{$date['name']}} ({{ $date['date'] }})

                                                                                            @php
                                                                                                $now = \Carbon\Carbon::now();
                                                                                                $daysRemaining = $now->diffInDays($date['date'])+1;
                                                                                                $daysLabel = trans_choice('shop.days', $daysRemaining);
                                                                                            @endphp
                                                                                            za {{$daysRemaining}} {{$daysLabel}}

                                                                                            @endforeach
                                                                                        </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                    <div id="refreshDayDelete">
                                                                        @if($shopping_list->delivery_date != null)
                                                                            <h4><small><a href="" class="deleteDay" data-id="{{$shopping_list->id}}"> Usuń date</a></small>
                                                                        @endif
                                                                    </div>
                                                                    <div>
                                                                        <button class="theme-btn-1 btn btn-effect-1 saveDay" data-id="{{$shopping_list->id}}" type="submit">
                                                                            {{ __('Zatwierdź') }}
                                                                        </button>
                                                                    </div>
                                                                    <br>
                                                                </div>
                                                            </div>
                                                            <div id="refreshActive">
                                                                <h4 class="pt-4 pb-2 mb-0">Status:</h4>
                                                                <strong class="">{!! \App\Enums\ShoppingListActive::getActiveText($shopping_list->active) !!}</strong>



                                                                <br>

                                                                <div class="shoping-cart-total mt-50">
                                                                    <h4>Podsumowanie</h4>
                                                                    <table class="table text-center table-sm">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td>Vat</td>
                                                                            <td>00,00</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>Kwota</strong></td>
                                                                            <td><strong>
                                                                                    {{ number_format($shopping_list->total, 2, ',', ' ') }} zł
                                                                                </strong></td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>




                                                                <div class="btn-wrapper">
                                                                    @if($shopping_list->status->isStop())
                                                                        <button class="theme-btn-1 btn btn-effect-1 "style="opacity: 0.6; cursor: not-allowed;"title="Zamówienie w realizacji" type="submit">
                                                                            {{ __('Dezaktywuj') }}
                                                                            @endif

                                                                            @if($shopping_list->active == false && !$shopping_list->status->isStop())
                                                                                <button class="theme-btn-1 btn btn-effect-1" id="activeChange" data-id="{{$shopping_list->id}}" type="submit">
                                                                                    {{
                                                                                        __('Aktywuj')
                                                                                    }}
                                                                                    @endif
                                                                                    @if($shopping_list->active == true && !$shopping_list->status->isStop())
                                                                                        <button class="theme-btn-1 btn btn-effect-1" id="activeChange" data-id="{{$shopping_list->id}}" type="submit">
                                                                                            {{
                                                                                            __('Dezaktywuj')
                                                                                       }}
                                                                                            @endif
                                                                                        </button>
                                                                </div>
                                                            </div>




                                                        </div>

                                                        @if(!$shopping_list->status->isStop())
                                                            <div class="btn-wrapper">
                                                                <a href="{{ route('shoppingList.upload', $shopping_list->id) }}"  class="theme-btn-2 btn btn-effect-2">{{ __('Edytuj zawartość listy zakupów') }}</a>
                                                            </div>
                                                        @else
                                                            <div class="btn-wrapper">
                                                                    <span class="theme-btn-2 btn btn-effect-2" style="opacity: 0.6; cursor: not-allowed;"title="Edycja zablokowana">
                                                                {{ __('Załaduj listę zakupów do dalszej edycji') }}
                                                            </span>
                                                            </div>
                                                        @endif


                                                        <br>
                                                        <div class="btn-wrapper">
                                                            <a href="{{ route('shoppingList.copyToCart', $shopping_list->id) }}" class="theme-btn-2 btn btn-effect-2">{{ __('Skopiuj zawartość listy zakupów do koszyka') }}</a>
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
                                        <form id="assignNewAddress" data-id="{{$shopping_list->id}} method="POST">
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
                                                    {{__('Zatwierdź')}}
                                                </button>

                                                <label>
                                                    <input class="form-check-input" name="checkboxSaveAddres" type="checkbox">
                                                    <label class="tag-label">Zapisz adres w ksiażce adresów</label>
                                                </label>
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



    <div class="ltn__modal-area ltn__quick-view-modal-area">
        <div class="modal fade" id="quick_view_edit_title" tabindex="-1">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" id="closeTitle" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <!-- <i class="fas fa-times"></i> -->
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="ltn__quick-view-modal-inner">
                            <div class="modal-product-item">
                                <div class="row">
                                    <div class="ltn__form-box">
                                        <form class="editTitle" id="title" method="POST">
                                            @csrf
                                            <div class="row mb-50">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label>Tytuł:</label>
                                                        <input id="title" type="text" placeholder="Np: dom, firma, środki czystości, napoje" value="{{$shopping_list->title}}"
                                                               class="form-control  @error('title') is-invalid @enderror"
                                                               name="title"
                                                               required autocomplete="title" autofocus>
                                                        @error('title')
                                                        <span class="invalid-feedback" role="alert">
                                                                          <strong>{{$message }}</strong>
                                                                             </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="btn-wrapper">
                                                <button type="submit"
                                                        class="btn theme-btn-1 btn-effect-1 text-uppercase saveTitle" data-id="{{$shopping_list->id}}">
                                                    {{__('Zapisz tytuł')}}
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
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\StoreAddressRequest') !!}

    </body>

@endsection

@section('javascript')
    const DATA = {
    saveDayUrl: '{{url('/shopping_list/save_day')}}/',
    deleteDayUrl: '{{url('/shopping_list/delete_day')}}/',
    selectAddressUrl: '{{url('address/select')}}/',
    storeAddressUrl: '{{url('address/store')}}',
    saveTitleUrl: '{{url('/shopping_list/save/title')}}/',


    }
@endsection
