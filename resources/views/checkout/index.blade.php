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

                                    <h4><a> Liczba produktów: {{$cart->getItems()->count()}}</a></h4>
                                    @foreach($cart->getItems() as $index => $item)
                                        <tr class="align-middle">
                                            <td class="cart-product-subtotal">{{ $index +1}}.</td>
                                            <td class="cart-product-image">
                                                <a href="product-details.html"><img src="{{asset('storage/' . $item->getImagePath())}}" alt="Zdjęcie"></a>
                                            </td>
                                            <td class="cart-product-info">
                                                <h4><a>{{$item->getName()}}</a></h4>
                                            </td>

                                            <td class="cart-product-subtotal">${{$item->getPrice()}}</td>


                                            <td class="cart-product-subtotal">x{{$item->getQuantity()}}</td>



                                            <td class="cart-product-subtotal">${{$item->getSubTotal()}}</td>
                                        </tr>
                                        @php $itemCounter++ @endphp
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
                                    <td>Vat</td>
                                    <td>$00.00</td>
                                </tr>
                                <tr>
                                    <td><strong>Order Total</strong></td>
                                    <td><strong>${{$cart->getSum()}}</strong></td>
                                </tr>
                                </tbody>
                            </table>

                            <div class="btn-wrapper text-right text-end">
                                <div class="mb-4"></div>
                                <form method="POST" action="{{ route('checkout.store') }}">
                                    <button class="theme-btn-1 btn btn-effect-1" type="submit">
                                        {{ __('Submit') }}
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- SHOPING CART AREA END -->
        </div>
    </div>


        <div class="ltn__checkout-area mb-105">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__checkout-inner">
                            <div class="ltn__checkout-single-content ltn__returning-customer-wrap">
                                <h5>Returning customer? <a class="ltn__secondary-color" href="#ltn__returning-customer-login" data-bs-toggle="collapse">Click here to login</a></h5>
                                <div id="ltn__returning-customer-login" class="collapse ltn__checkout-single-content-info">
                                    <div class="ltn_coupon-code-form ltn__form-box">
                                        <p>Please login your accont.</p>
                                        <form action="#" >
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-item input-item-name ltn__custom-icon">
                                                        <input type="text" name="ltn__name" placeholder="Enter your name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-item input-item-email ltn__custom-icon">
                                                        <input type="email" name="ltn__email" placeholder="Enter email address">
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn theme-btn-1 btn-effect-1 text-uppercase">Login</button>
                                            <label class="input-info-save mb-0"><input type="checkbox" name="agree"> Remember me</label>
                                            <p class="mt-30"><a href="register.html">Lost your password?</a></p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="ltn__checkout-single-content ltn__coupon-code-wrap">
                                <h5>Have a coupon? <a class="ltn__secondary-color" href="#ltn__coupon-code" data-bs-toggle="collapse">Click here to enter your code</a></h5>
                                <div id="ltn__coupon-code" class="collapse ltn__checkout-single-content-info">
                                    <div class="ltn__coupon-code-form">
                                        <p>If you have a coupon code, please apply it below.</p>
                                        <form action="#" >
                                            <input type="text" name="coupon-code" placeholder="Coupon code">
                                            <button class="btn theme-btn-2 btn-effect-2 text-uppercase">Apply Coupon</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="ltn__checkout-single-content mt-50">
                                <h4 class="title-2">Billing Details</h4>
                                <div class="ltn__checkout-single-content-info">
                                    <form action="#" >
                                        <h6>Personal Information</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-item input-item-name ltn__custom-icon">
                                                    <input type="text" name="ltn__name" placeholder="First name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-item input-item-name ltn__custom-icon">
                                                    <input type="text" name="ltn__lastname" placeholder="Last name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-item input-item-email ltn__custom-icon">
                                                    <input type="email" name="ltn__email" placeholder="email address">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-item input-item-phone ltn__custom-icon">
                                                    <input type="text" name="ltn__phone" placeholder="phone number">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-item input-item-website ltn__custom-icon">
                                                    <input type="text" name="ltn__company" placeholder="Company name (optional)">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-item input-item-website ltn__custom-icon">
                                                    <input type="text" name="ltn__phone" placeholder="Company address (optional)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <h6>Country</h6>
                                                <div class="input-item">
                                                    <select class="nice-select">
                                                        <option>Select Country</option>
                                                        <option>Australia</option>
                                                        <option>Canada</option>
                                                        <option>China</option>
                                                        <option>Morocco</option>
                                                        <option>Saudi Arabia</option>
                                                        <option>United Kingdom (UK)</option>
                                                        <option>United States (US)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <h6>Address</h6>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="input-item">
                                                            <input type="text" placeholder="House number and street name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-item">
                                                            <input type="text" placeholder="Apartment, suite, unit etc. (optional)">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <h6>Town / City</h6>
                                                <div class="input-item">
                                                    <input type="text" placeholder="City">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <h6>State </h6>
                                                <div class="input-item">
                                                    <input type="text" placeholder="State">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <h6>Zip</h6>
                                                <div class="input-item">
                                                    <input type="text" placeholder="Zip">
                                                </div>
                                            </div>
                                        </div>
                                        <p><label class="input-info-save mb-0"><input type="checkbox" name="agree"> Create an account?</label></p>
                                        <h6>Order Notes (optional)</h6>
                                        <div class="input-item input-item-textarea ltn__custom-icon">
                                            <textarea name="ltn__message" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ltn__checkout-payment-method mt-50">
                            <h4 class="title-2">Payment Method</h4>
                            <div id="checkout_accordion_1">
                                <!-- card -->
                                <div class="card">
                                    <h5 class="collapsed ltn__card-title" data-bs-toggle="collapse" data-bs-target="#faq-item-2-1" aria-expanded="false">
                                        Check payments
                                    </h5>
                                    <div id="faq-item-2-1" class="collapse" data-parent="#checkout_accordion_1">
                                        <div class="card-body">
                                            <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- card -->
                                <div class="card">
                                    <h5 class="ltn__card-title" data-bs-toggle="collapse" data-bs-target="#faq-item-2-2" aria-expanded="true">
                                        Cash on delivery  <img src="img/icons/cash.png" alt="#">
                                    </h5>
                                    <div id="faq-item-2-2" class="collapse show" data-parent="#checkout_accordion_1">
                                        <div class="card-body">
                                            <p>Pay with cash upon delivery.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- card -->
                                <div class="card">
                                    <h5 class="collapsed ltn__card-title" data-bs-toggle="collapse" data-bs-target="#faq-item-2-3" aria-expanded="false" >
                                        ApplePay  <img src="img/icons/applepay.png" alt="#">
                                    </h5>
                                    <div id="faq-item-2-3" class="collapse" data-parent="#checkout_accordion_1">
                                        <div class="card-body">
                                            <p>Apple Pay is the modern way to pay.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- card -->
                                <div class="card">
                                    <h5 class="collapsed ltn__card-title" data-bs-toggle="collapse" data-bs-target="#faq-item-2-4" aria-expanded="false" >
                                        PayPal <img src="img/icons/payment-3.png" alt="#">
                                    </h5>
                                    <div id="faq-item-2-4" class="collapse" data-parent="#checkout_accordion_1">
                                        <div class="card-body">
                                            <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ltn__payment-note mt-30 mb-30">
                                <p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.</p>
                            </div>
                            <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">Place order</button>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="shoping-cart-total mt-50">
                            <h4 class="title-2">Cart Totals</h4>
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>Vegetables Juices <strong>× 2</strong></td>
                                    <td>$298.00</td>
                                </tr>
                                <tr>
                                    <td>Orange Sliced Mix <strong>× 2</strong></td>
                                    <td>$170.00</td>
                                </tr>
                                <tr>
                                    <td>Red Hot Tomato <strong>× 2</strong></td>
                                    <td>$150.00</td>
                                </tr>
                                <tr>
                                    <td>Shipping and Handing</td>
                                    <td>$15.00</td>
                                </tr>
                                <tr>
                                    <td>Vat</td>
                                    <td>$00.00</td>
                                </tr>
                                <tr>
                                    <td><strong>Order Total</strong></td>
                                    <td><strong>$633.00</strong></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- WISHLIST AREA START -->


    </div>
    <!-- Body main wrapper end -->

    @endsection

    @section('javascript')
        const DATA = {
        editfieldUrl: '{{url('cart')}}/',

        }
@endsection