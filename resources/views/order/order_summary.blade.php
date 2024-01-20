@extends('layouts.appwhite')

@section('content')



    <!-- Add your site or application content here -->
    <!-- Body main wrapper start -->
    <div class="body-wrapper">

        <!-- BREADCRUMB AREA START -->
        <div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image" data-bg="{{asset('img/bg_used/9.jpg')}}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                            <div class="section-title-area ltn__section-title-2">
                                <h6 class="section-subtitle ltn__secondary-color"></h6>
                                <h1 class="section-title white-color">Podsumowanie zamówienia</h1>
                            </div>
                            <div class="ltn__breadcrumb-list">
                                <ul>
                                    <li><a>Start</a></li>
                                    <li>Podsumowanie zamówienia</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BREADCRUMB AREA END -->

        <!-- LOGIN AREA START -->
        <div class="ltn__login-area mb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="account-login-inner section-bg-1">
                            <form action="#" class="ltn__form-box contact-form-box">
                                <p class="text-center"></p>
                                    <p class="text-center">
                                    <label>Numer zamówienia:</label>
                                    <h1 class="text-center">#{{$order->id}}</h1>
                                 <br>
                                    </p>


                                <table class="table text-center">
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


                                        @foreach($order->shopping_list->shopping_lists_products as $index => $item)
                                            <tr class="align-middle">
                                                <td class="cart-product-subtotal">{{ $index +1}}.</td>
                                                <td class="cart-product-image">
                                                    <a href="product-details.html"><img src="{{asset('storage/' . $item->product->image->name)}}" alt="Zdjęcie"></a>
                                                </td>
                                                <td class="cart-product-info">
                                                    <h4><a>{{$item->product->name}}</a></h4>
                                                </td>

                                                <td class="cart-product-subtotal">{{ number_format($item->product->price, 2, ',', ' ') }} zł</td>
                                                <td class="cart-product-subtotal">x{{$item->quantity}}</td>
                                                <td class="cart-product-subtotal">{{ number_format($item->sub_total, 2, ',', ' ') }} zł</td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>


                                <p >
                                    <label>Dostawa: </label>

                                    {{ \Carbon\Carbon::parse($order->shopping_list->delivery_date)->locale('pl')->isoFormat('dddd') . ', '}}
                                            {{ date('Y-m-d', strtotime($order->shopping_list->delivery_date)) }}
                                </p>

                                    <td>Adres:</td>
                                    <p><strong>{{$order->shopping_list->address->name}} {{{$order->shopping_list->address->surname}}}</strong></p>
                                    <p>{{$order->shopping_list->address->city}}, {{$order->shopping_list->address->street}}<br>
                                        {{$order->shopping_list->address->zip_code}}, {{$order->shopping_list->address->voivodeship}}</p>
                                    <p>Telefon: {{$order->shopping_list->address->phone_number}}</p>

                                <p class="text-center">
                                    <label>Przygotuj taką kwotę:</label>
                                <br>
                                </p>

                                <div class="shoping-cart-total mt-0 w-25">
                                    <h4>Podsumowanie</h4>
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>Vattt</td>
                                        <td>00,00 zł</td>
                                    </tr>
                                    <tr>
                                        <td>Kwota</td>
                                        <td><strong>
                                                {{ number_format($order->shopping_list->total, 2, ',', ' ') }} zł
                                            </strong></td>
                                    </tr>
                                    </tbody>
                                </table>
                                </div>

                                <div class="mt-150"></div>


                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- LOGIN AREA END -->


    </div>

    <!-- Body main wrapper end -->

    @endsection

    @section('javascript')
        const DATA = {
        editfieldUrl: '{{url('cart')}}/',

        }
@endsection
