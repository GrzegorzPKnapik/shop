@extends('layouts.app')

@section('content')

    <div class="body-wrapper">

        <!-- BREADCRUMB AREA START -->
        <div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image" data-bg="{{ asset('img/bg/9.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                            <div class="section-title-area ltn__section-title-2">
                                <h6 class="section-subtitle ltn__secondary-color">Edycja produktu</h6>
                                <h1 class="section-title white-color">Edit Product</h1>
                            </div>
                            <div class="ltn__breadcrumb-list">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li>Product</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BREADCRUMB AREA END -->

        <!-- LOGIN AREA START -->
        <div class="ltn__login-area pb-65">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title-area text-center">
                            <h1 class="section-title">Sign In <br>To  Your Account</h1>
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. <br>
                                Sit aliquid,  Non distinctio vel iste.</p>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-6">
                        <div class="account-login-inner">
                            <form class="ltn__form-box contact-form-box" method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <input id="product_name" type="text" placeholder="nazwa" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ $product->name }}" required autocomplete="product_name" autofocus>
                                @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message }}</strong>
                                    </span>
                                @enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="input-item">
                                        <label>Kategoria:</label>
                                        <select name="category_select" class="nice-select form-control @error('category_select') is-invalid @enderror">
                                            <option value="{{ $product->category->id }}">{{ $product->category->name }}</option>
                                            @foreach($categories as $category)
                                                @if($category->id != $product->category->id)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('category_select')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-item">
                                        <label>Kategoria:</label>
                                        <select name="producer_select" class="nice-select form-control @error('producer_select') is-invalid @enderror">
                                            <option value="{{ $product->producer->id }}">{{ $product->producer->name }}</option>
                                            @foreach($producers as $producer)
                                                @if($producer->id != $product->producer->id)
                                                <option value="{{ $producer->id }}">{{ $producer->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('producer_select')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <textarea id="description_name" type="text" placeholder="opis" class="form-control @error('description_name') is-invalid @enderror" name="description_name" rows="5" cols="40" required autocomplete="description_name" autofocus></textarea>
                                    @error('description_name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <input id="product_price" type="text" placeholder="cena" class="form-control @error('product_price') is-invalid @enderror" name="product_price" value="{{ $product->price }}" required autocomplete="product_price" autofocus>
                                    @error('product_price')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                <input id="image_name" type="file" class="form-control @error('image_name') is-invalid @enderror" name="image_name" autofocus onchange="loadFile(event)">
                                .png
                                </div>
                                @error('image_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror




                                <table class="table table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th width="50%" >Stare zdjęcie</th>
                                        <th width="50%">Nowe zdjęcie</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>@if(!is_null($product->image->name))
                                                    <img src="{{ asset('storage/' . $product->image->name) }}" width="200" height="200">
                                                @endif</td>
                                            <td><img id="output" alt="Product image" width="200" height="200" style="display: none"/></td>

                                        </tr>
                                    </tbody>
                                </table>





                                <div class="btn-wrapper mt-0">
                                    <button class="theme-btn-1 btn btn-block" type="submit">
                                        {{ __('Zatwierdź') }}
                                    </button>
                                </div>



                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="account-create text-center pt-50">
                            <h4>DON'T HAVE AN ACCOUNT?</h4>
                            <p>Add items to your wishlistget personalised recommendations <br>
                                check out more quickly track your orders register</p>
                            <div class="btn-wrapper">
                                <a href="{{ route('register') }}" class="theme-btn-1 btn black-btn">{{ __('Rejestracja') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- LOGIN AREA END -->

    <!-- FEATURE AREA START ( Feature - 3) -->
    <div class="ltn__feature-area before-bg-bottom-2 mb--30--- plr--5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__feature-item-box-wrap ltn__border-between-column white-bg">
                        <div class="row">
                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="ltn__feature-item ltn__feature-item-8">
                                    <div class="ltn__feature-icon">
                                        <img src="{{ asset('img/icons/icon-img/11.png') }}" alt="#">
                                    </div>
                                    <div class="ltn__feature-info">
                                        <h4>Curated Products</h4>
                                        <p>Provide Curated Products for
                                            all product over $100</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="ltn__feature-item ltn__feature-item-8">
                                    <div class="ltn__feature-icon">
                                        <img src="{{ asset('img/icons/icon-img/12.png') }}" alt="#">
                                    </div>
                                    <div class="ltn__feature-info">
                                        <h4>Handmade</h4>
                                        <p>We ensure the product quality
                                            that is our main goal</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="ltn__feature-item ltn__feature-item-8">
                                    <div class="ltn__feature-icon">
                                        <img src="{{ asset('img/icons/icon-img/13.png') }}" alt="#">
                                    </div>
                                    <div class="ltn__feature-info">
                                        <h4>Natural Food</h4>
                                        <p>Return product within 3 days
                                            for any product you buy</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 col-12">
                                <div class="ltn__feature-item ltn__feature-item-8">
                                    <div class="ltn__feature-icon">
                                        <img src="{{ asset('img/icons/icon-img/14.png') }}" alt="#">
                                    </div>
                                    <div class="ltn__feature-info">
                                        <h4>Free home delivery</h4>
                                        <p>We ensure the product quality
                                            that you can trust easily</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FEATURE AREA END -->

    <!-- Utilize Cart Menu Start -->
    <!-- Utilize Cart Menu End -->

    <!-- Utilize Mobile Menu Start -->
    <!-- Utilize Mobile Menu End -->

    <div class="ltn__utilize-overlay"></div>

</div>
@endsection

@section('js-files')
    <script src="{{ asset('js/preview_image.js') }}"></script>
@endsection
