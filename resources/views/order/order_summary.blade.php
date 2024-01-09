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
                                <h6 class="section-subtitle ltn__secondary-color">//  Welcome to our company</h6>
                                <h1 class="section-title white-color">Order summary</h1>
                            </div>
                            <div class="ltn__breadcrumb-list">
                                <ul>
                                    <li><a>Home</a></li>
                                    <li>Order summary</li>
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
                                <p class="text-center"> To track your order please enter your Order ID in the box below and press the "Track Order" button. This was given to you on your receipt and in the confirmation email you should have received. </p>
                                    <p class="text-center">
                                    <label>Order ID:</label>
                                    <h1 class="text-center">#{{$order->id}}</h1>
                                 <br>
                                    </p>


                                <table class="table text-center">
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


                                        @foreach($order->shopping_list->shopping_lists_products as $index => $item)
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


                                    </tbody>
                                </table>


                                <p >
                                    <label>Dostawa: </label>

                                    {{ \Carbon\Carbon::parse($order->shopping_list->delivery_date)->locale('pl')->isoFormat('dddd') . ', '}}
                                            {{ date('Y-m-d', strtotime($order->shopping_list->delivery_date)) }}
                                </p>

                                    <td>Address:</td>
                                    <p><strong>{{$order->shopping_list->address->name}} {{{$order->shopping_list->address->surname}}}</strong></p>
                                    <p>{{$order->shopping_list->address->city}}, {{$order->shopping_list->address->street}}<br>
                                        {{$order->shopping_list->address->zip_code}}, {{$order->shopping_list->address->voivodeship}}</p>
                                    <p>Telefon: {{$order->shopping_list->address->phone_number}}</p>

                                <p class="text-center">
                                    <label>Przygotuj taką kwotę:</label>
                                <br>
                                </p>

                                <div class="shoping-cart-total mt-0 w-25">
                                    <h4>Order total</h4>
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>Vat</td>
                                        <td>$00.00</td>
                                    </tr>
                                    <tr>
                                        <td>Order Total</td>
                                        <td><strong>$
                                                    {{$order->shopping_list->total}}
                                            </strong></td>
                                    </tr>
                                    </tbody>
                                </table>
                                </div>



                                <input type="text" name="email" placeholder="Email you used during checkout.">
                                <div class="btn-wrapper mt-0 text-center">
                                    <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">Track Order</button>
                                </div>
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
