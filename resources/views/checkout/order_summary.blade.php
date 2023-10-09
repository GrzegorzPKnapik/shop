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
                                <label>Order ID:</label>
                                <h1>#{{$cart->id}}</h1>
                                <label>Billing email</label>
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
