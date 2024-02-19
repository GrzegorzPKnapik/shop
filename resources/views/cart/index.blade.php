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

    </style>
    <body>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- Add your site or application content here -->

    <style>
        /* Ukryj przyciski zwiększania i zmniejszania dla input typu "number" */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }


    </style>

    <!-- Body main wrapper start -->
    <div class="body-wrapper">
        @include('helpers.responses')
        <div class="ltn__utilize-overlay"></div>

        <!-- BREADCRUMB AREA START -->
        <div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image" data-bg="img/bg_used/4.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                            <div class="section-title-area ltn__section-title-2">
                                <h6 class="section-subtitle ltn__secondary-color"></h6>
                                <h1 class="section-title white-color">Koszyk</h1>
                            </div>
                            <div class="ltn__breadcrumb-list">
                                <ul>
                                    <li><a href="index.html">Start</a></li>
                                    <li>Koszyk</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BREADCRUMB AREA END -->
        <!-- SHOPING CART AREA START -->
        <div id="refreshSC">
            <div class="liton__shoping-cart-area mb-120">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shoping-cart-inner">
                                <div class="table-responsive">

                                    <table class="table text-center table-sm">
                                        <thead>
                                        <tr>
                                            <th>Akcje</th>
                                            <th>Zdjęcie</th>
                                            <th>Nazwa</th>
                                            <th>Cena</th>
                                            <th>Ilość</th>
                                            <th>Suma częściowa</th>


                                        </tr>
                                        </thead>


                                        <tbody>
                                        @if(!isset($cart))
                                            <h4><a> Liczba produktów w koszyku: 0</a></h4>





                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="shoping-cart-total mt-50">
                                <h4>Podsumowanie</h4>
                                <table class="table text-center table-sm">
                                    <tbody>
                                    <tr>
                                        <td>Vat</td>
                                        <td>$00.00</td>
                                    </tr>
                                    <td><strong>Kwota</strong></td>
                                    <tr>
                                        <td><strong>Kwota</strong></td>
                                        <td><strong>$
                                                {{$cart->total}}
                                            </strong></td>
                                    </tr>
                                </table>
                                <div class="btn-wrapper text-right text-end">
                                    <a href="checkout.html" class="theme-btn-1 btn btn-effect-1">Kasa</a>
                                </div>
                            </div>
                            @endif



                            @if(isset($cart))
                                <h4><a> Liczba produktów w koszyku: {{$items->count()}}</a></h4>

                                @foreach($items as $item)
                                    <tr class="align-middle delete_mem{{$item->PRODUCTS_id}}">
                                        <td>
                                            <button class="icon-cancel delete" data-id="{{$item->PRODUCTS_id}}"></button>
                                        </td>
                                        <td class="cart-product-image">
                                            <a href="{{route('shop.product', $item->PRODUCTS_id)}}"><img class="{{$item->product->status->isSoldOut() ? 'disabled-icon' : ''}}" src="{{asset('storage/' . $item->product->image->name)}}" alt="Zdjęcie"></a>
                                        </td>
                                        <td class="cart-product-info">
                                            <h4><a>{{$item->product->name}}</a></h4>
                                        </td>

                                        <td class="cart-product-subtotal">{{ number_format($item->product->price, 2, ',', ' ') }} zł</td>



                                        <td class="cart-product-quantity">
                                            <label for="valueQuantity">max 99sztuk:</label>
                                            <div class="cart-plus-minus m-auto">
                                                <div class="dec qtybutton decrement" data-id="{{$item->PRODUCTS_id}}">-</div>
                                                <input type="number" value="{{$item->quantity}}" name="valueQuantity" id="valueQuantity" class="cart-plus-minus-box cart_quantity_input" data-id="{{$item->PRODUCTS_id}}">
                                                <div class="inc qtybutton increment" data-id="{{$item->PRODUCTS_id}}">+</div>
                                            </div>
                                        </td>



                                        <td class="cart-product-subtotal">{{ number_format($item->sub_total, 2, ',', ' ') }} zł</td>
                                    </tr>

                                @endforeach



                                </tbody>
                                </table>
                        </div>
                    </div>

                    <div class="shoping-cart-total mt-50">
                        <h4>Podsumowanie</h4>
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Vat</td>
                                <td>00,00 zł</td>
                            </tr>
                            <td><strong>Kwota</strong></td>
                            <td><strong>
                                    {{ number_format($cart->total, 2, ',', ' ') }} zł
                                </strong></td>
                            </tbody>
                        </table>
                        <div class="btn-wrapper text-right text-end">
                            @if(!$cart->mode->isShoppingList())
                            <a href="{{ route('checkout.index') }}" class="theme-btn-1 btn btn-effect-1">Przejdź do kasy</a>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- SHOPING CART AREA END -->
    </div>
    </div>




    @endsection
    @section('javascript')
        const incUrl = "{{url('cart/increment')}}/";
        const decUrl = "{{url('cart/decrement')}}/";
@endsection
@section('js-files')
@endsection
