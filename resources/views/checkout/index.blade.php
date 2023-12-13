@extends('layouts.app')

@section('content')

    <body>


    <!-- Add your site or application content here -->

    <!-- Body main wrapper start -->
    <div class="body-wrapper">



        <!-- BREADCRUMB AREA START -->
        <div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image" data-bg="img/bg/9.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                            <div class="section-title-area ltn__section-title-2">
                                <h6 class="section-subtitle ltn__secondary-color">//  Welcome to our company</h6>
                                <h1 class="section-title white-color">Checkout</h1>
                            </div>
                            <div class="ltn__breadcrumb-list">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li>Checkout</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BREADCRUMB AREA END -->

        <!-- WISHLIST AREA START -->
        <div class="liton__shoping-cart-area mb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shoping-cart-inner">
                            <div class="table-responsive">

                                <table class="table text-center table-sm">
                                    <thead>
                                    <tr>
                                        <th>Number</th>
                                        <th>Image</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>SubTotal</th>
                                    </tr>
                                    </thead>


                                    <tbody>

                                    @if(isset($cart))
                                        <h4><a> Liczba produktów w koszyku: {{$items->count()}}</a></h4>
                                        @foreach($items as $index => $item)
                                            <tr class="align-middle">
                                                <td class="cart-product-subtotal">{{ $index +1}}.</td>
                                                <td class="cart-product-image">
                                                    <a href="product-details.html"><img src="{{asset('storage/' . $item->product->image->name)}}" alt="Zdjęcie"></a>
                                                </td>
                                                <td class="cart-product-info">
                                                    <h4><a>{{$item->product->name}}</a></h4>
                                                </td>

                                                <td class="cart-product-subtotal">${{$item->product->price}}</td>
                                                <td class="cart-product-subtotal">x{{$item->quantity}}</td>



                                                <td class="cart-product-subtotal">${{$item->sub_total}}</td>
                                            </tr>
                                        @endforeach
                                    @endif


                                    <tr class="cart-coupon-row">
                                        <td colspan="5">
                                            <div class="cart-coupon">
                                                <input type="text" name="cart-coupon" placeholder="Coupon code">
                                                <button type="submit" class="btn theme-btn-2 btn-effect-2">Apply Coupon</button>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn theme-btn-2 btn-effect-2-- disabled">Update Cart</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>



                                <div id="refreshAddress">




                                    <h4>Adres dostawy: </h4>
                                    @foreach($addresses as $address)
                                        @if($address->selected == true)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="selected1" id="flexRadioDefault2"
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
                                    <p>
                                    <h4><small><a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                Wybierz inny adres
                                            </a></small></h4>
                                    </p>

                                    <div class="collapse" id="collapseExample">
                                        <div class="card card-body">
                                            @foreach($addresses as $address)

                                                    <div class="form-check selectAddress" data-id="{{$address->id}}">
                                                        <input class="form-check-input" type="radio" name="selected2" id="flexRadioDefault2"
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
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <h4><small><a data-bs-target="#quick_view_modal" href="#" data-bs-toggle="modal" role="button" title="Quick View">
                                    Wpisz adres dostawy
                                </a></small></h4>


                        <h4 class="pt-4 pb-2">Dostawa:</h4>

                        <span id="deliveryDate">
                        @foreach($deliveryDate as $dDate)

                          {{$dDate['name'] }}, {{$dDate['date']}}
                                @endforeach
                        </span>

                        <h4 class="pt-4 pb-2">Wybierz date dostawy:</h4>


                            <form class="selectDay" method="POST">
                                    @csrf

                                <input type="hidden" name="deliveryDate" value="{{ $deliveryDate }}">

                                <div class="col-md-6">
                                    <div class="input-item">
                                        <select name="select" class="nice-select" id="deliveryDateSelect">
                                                @foreach($collectionDates as $date)
                                                <option value={{$date['date']}} {{ $date['date'] == $dDate['date'] ? 'selected' : '' }}> {{$date['name']}} ({{ $date['date'] }})
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
                                            @if(isset($cart))
                                                {{$cart->total}}@endif</strong></td>
                                </tr>
                                </tbody>
                            </table>


                            <div class="btn-wrapper text-right text-end">
                                <div class="mb-4"></div>


                                <button class="theme-btn-1 btn btn-effect-1 storeOrder" type="submit">
                                    {{ __('Submit') }}
                                </button>


                            </div>

                        </div>


                    </div>
                </div>
            </div>
            <!-- SHOPING CART AREA END -->
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



                                                    <label>
                                                        <input class="form-check-input" name="checkboxSaveAddres" type="checkbox">
                                                        <label class="tag-label">zapisz adres w ksiażce adresów</label>
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
    <!-- WISHLIST AREA START -->


    <!-- Body main wrapper end -->


    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\StoreAddressRequest') !!}
    @endsection

    @section('javascript')
        const DATA = {
        editfieldUrl: '{{url('cart')}}/',
        selectAddressUrl: '{{url('address/select')}}/',
        storeAddressUrl: '{{url('address/store')}}',
        storeOrderUrl: '{{url('/order/store')}}',
        summaryUrl: '{{url('/order/summary')}}/',
        }
@endsection
