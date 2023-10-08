@extends('layouts.appwhite')

@section('content')

    <body>


    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- Add your site or application content here -->

    <!-- Body main wrapper start -->
    <div class="body-wrapper">
        @include('helpers.responses')
        <div class="ltn__utilize-overlay"></div>

        <!-- BREADCRUMB AREA START -->
        <div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image" data-bg="img/bg/9.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                            <div class="section-title-area ltn__section-title-2">
                                <h6 class="section-subtitle ltn__secondary-color">//  Welcome to our company</h6>
                                <h1 class="section-title white-color">Cart</h1>
                            </div>
                            <div class="ltn__breadcrumb-list">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li>Cart</li>
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

                                    <table class="table text-center">
                                        <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>Image</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>SubTotal</th>
                                        </tr>
                                        </thead>


                                        <tbody>
@if(isset($cart))
                                        <h4><a> Liczba produktów w koszyku: {{$cart->total}}</a></h4>
                                        @foreach($items as $index => $item)
                                            {{$index+1}}
                                            <tr class="align-middle delete_mem{{$item->PRODUCTS_id}}">
                                                <td>
                                                    <button class="icon-cancel delete" data-id="{{$item->PRODUCTS_id}}"></button>
                                                </td>
                                                <td class="cart-product-image">
                                                    <a href="product-details.html"><img src="{{asset('storage/' . $item->product->image->name)}}" alt="Zdjęcie"></a>
                                                </td>
                                                <td class="cart-product-info">
                                                    <h4><a>{{$item->product->name}}</a></h4>
                                                </td>

                                                <td class="cart-product-subtotal">${{$item->product->price}}</td>

                                                <td class="cart-product-quantity " data-th="Quantity">
                                                    <div class="cart-plus-minus m-auto">
                                                        <div class="dec qtybutton" data-id="{{$item->PRODUCTS_id}}">-</div>
                                                        <input type="button" value="{{$item->quantity}}" class="cart-plus-minus-box cart_update">
                                                        <div class="inc qtybutton" data-id="{{$item->PRODUCTS_id}}">+</div>
                                                    </div>
                                                </td>



                                                <td class="cart-product-subtotal">${{$item->sub_total}}</td>
                                            </tr>

                                        @endforeach


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
                                </div>
                            </div>

                            <div class="shoping-cart-total mt-50">
                                <h4>Cart Totals</h4>
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>Cart Subtotal</td>
                                        <td>$618.00</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping and Handing</td>
                                        <td>$15.00</td>
                                    </tr>
                                    <tr>
                                        <td>Vat</td>
                                        <td>$00.00</td>
                                    </tr>
                                    <td><strong>Order Total</strong></td>
                                    <td><strong>
                                            ${{$cart->total}}
                                        </strong></td>
                                    </tbody>
                                </table>
                                <div class="btn-wrapper text-right text-end">
                                    <a href="checkout.html" class="theme-btn-1 btn btn-effect-1">Proceed to checkout</a>
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
