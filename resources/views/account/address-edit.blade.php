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
                                <h1 class="section-title white-color">Address edit</h1>
                            </div>
                            <div class="ltn__breadcrumb-list">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li>My Account</li>
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
                                                <a class="active show" data-bs-toggle="tab">Address edit <i
                                                        class="fas fa-file-alt"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="tab-content">

                                                <div class="ltn__myaccount-tab-content-inner">
                                                    <p>Edycja adresu</p>
                                                    <div class="ltn__form-box">
                                                        <form  method="POST" action="{{ route('address.update', $address->id) }}" >
                                                            @csrf

                                                            <div class="row mb-50">
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label>Miasto:</label>
                                                                        <input id="city" type="text" placeholder="miasto"
                                                                               class="form-control @error('city') is-invalid @enderror"
                                                                               name="city" value="{{$address->city }}"
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
                                                                        <input id="street" type="text" placeholder="ulica"
                                                                               class="form-control @error('street') is-invalid @enderror"
                                                                               name="street" value="{{ $address->street}}"
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
                                                                        <input id="zip_code" type="text" placeholder="kod pocztowy"
                                                                               class="form-control @error('zip_code') is-invalid @enderror"
                                                                               name="zip_code" value="{{ $address->zip_code}}"
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
                                                                        <input id="voivodeship" type="text" placeholder="województwo"
                                                                               class="form-control @error('voivodeship') is-invalid @enderror"
                                                                               name="voivodeship" value="{{ $address->voivodeship}}"
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
                                                                        <input id="phone_number" type="text" placeholder="numer telefonu"
                                                                               class="form-control @error('phone_number') is-invalid @enderror"
                                                                               name="phone_number" value="{{ $address->contact->phone_number}}"
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
                                                                        class="btn theme-btn-1 btn-effect-1 text-uppercase">
                                                                    {{__('Save changes')}}
                                                                </button>
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
                        <!-- PRODUCT TAB AREA END -->
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
    editfieldUrl: '{{url('cart')}}/',

    }
@endsection
