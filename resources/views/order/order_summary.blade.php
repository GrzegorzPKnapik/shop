@extends('layouts.app')

@section('content')



    <!-- Add your site or application content here -->
    <!-- Body main wrapper start -->
    <div class="body-wrapper">

        <!-- BREADCRUMB AREA START -->
        <div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image" data-bg="{{asset('img/bg/9.jpg')}}">
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
                                @foreach($items as $item)
                                    <p class="text-center">
                                    <label>Order ID:</label>
                                    <h1 class="text-center">#{{$item->order_id}}</h1>
                                 <br>
                                    </p>
                                    @php break;@endphp
                                @endforeach


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


                                        @foreach($items as $index => $item)
                                            <tr class="align-middle">
                                                <td class="cart-product-subtotal">{{ $index +1}}.</td>
                                                <td class="cart-product-image">
                                                    <a href="product-details.html"><img src="{{asset('storage/' . $item->name)}}" alt="Zdjęcie"></a>
                                                </td>
                                                <td class="cart-product-info">
                                                    <h4><a>{{$item->product_name}}</a></h4>
                                                </td>

                                                <td class="cart-product-subtotal">${{$item->price}}</td>
                                                <td class="cart-product-subtotal">x{{$item->quantity}}</td>
                                                <td class="cart-product-subtotal">${{$item->sub_total}}</td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>


                                <p >
                                    @foreach($order as $item)
                                        @if($item->shopping_list->mode != 'shopping_list')
                                    <label>Dostawa: </label>
                                        @endif

                                    @if($item->shopping_list->mode == 'shopping_list')
                                    <label>Ustawiony dzień realizacji cyklicznych dostaw: </label>
                                        @endif
                                    {{ \Carbon\Carbon::parse($item->shopping_list->delivery_date)->locale('pl')->isoFormat('dddd') . ', '}}
                                        @if($item->shopping_list->mode == 'shopping_list')
                                        <label>Najbliższa data cyklicznej dostawy: </label>
                                        @endif
                                            {{ date('Y-m-d', strtotime($item->shopping_list->delivery_date)) }}
                                    @php break;@endphp
                                    @endforeach
                                    <br>
                                </p>

                                @foreach($order as $item)
                                    <td>Address:</td>
                                    <p><strong>{{$item->shopping_list->address->name}} {{{$item->shopping_list->address->surname}}}</strong></p>
                                    <p>{{$item->shopping_list->address->city}}, {{$item->shopping_list->address->street}}<br>
                                        {{$item->shopping_list->address->zip_code}}, {{$item->shopping_list->address->voivodeship}}</p>
                                    <p>Telefon: {{$item->shopping_list->address->phone_number}}</p>
                                    @php break;@endphp
                                @endforeach

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
                                                @foreach($items as $item)
                                                    {{$item->total}}
                                                    @php break; @endphp
                                                @endforeach
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
