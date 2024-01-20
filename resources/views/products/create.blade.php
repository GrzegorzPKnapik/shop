@extends('layouts.appwhite')

@section('content')

    <div class="body-wrapper">

        <!-- BREADCRUMB AREA START -->
        <div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image" data-bg="{{ asset('img/bg_used/8.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                            <div class="section-title-area ltn__section-title-2">
                                <h6 class="section-subtitle ltn__secondary-color">// witamy w naszym sklepie</h6>
                                <h1 class="section-title white-color">Dodawanie produktu</h1>
                            </div>
                            <div class="ltn__breadcrumb-list">
                                <ul>
                                    <li><a href="index.html">Start</a></li>
                                    <li>Dodawanie produktu</li>
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
                    <div class="col-lg-6">
                        <div class="account-login-inner">
                            <form class="ltn__form-box contact-form-box" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <input id="product_name" type="text" placeholder="nazwa" class="form-control @error('product_name') is-invalid @enderror" name="product_name" required autocomplete="name" autofocus>
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
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_select')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="input-item">
                                        <label>Producent:</label>
                                        <select name="producer_select" class="nice-select form-control @error('producer_select') is-invalid @enderror">
                                            @foreach($producers as $producer)
                                                <option value="{{ $producer->id }}">{{ $producer->name }}</option>
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

<!--                                <div class="mb-3">
                                    <input id="description_ingredients" type="text" placeholder="składniki" class="form-control @error('description_ingredients') is-invalid @enderror" name="description_ingredients" required autocomplete="description_ingredients" autofocus>
                                    @error('description_ingredients')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message }}</strong>
                                    </span>
                                    @enderror
                                </div>-->

                                <div class="mb-3">
                                    <textarea id="description_ingredients" type="text" placeholder="składniki" class="form-control @error('description_ingredients') is-invalid @enderror" name="description_ingredients" rows="5" cols="40" required autocomplete="description_ingredients" autofocus></textarea>
                                    @error('description_ingredients')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <input id="description_calories" type="text" placeholder="kalorie" class="form-control @error('description_calories') is-invalid @enderror" name="description_calories" required autocomplete="description_calories" autofocus>
                                    @error('description_calories')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <input id="product_price" type="text" placeholder="cena" class="form-control @error('product_price') is-invalid @enderror" name="product_price" required autocomplete="product_price" autofocus>
                                    @error('product_price')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <input id="image_name" type="file" class="form-control @error('image_name') is-invalid @enderror" name="image_name"  autofocus onchange="loadFile(event)">
                                    .png
                                </div>
                                @error('image_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div>
                                    <img id="output" alt="Product image" class="mt-3" width="200" height="200" style="display: none;"/>
                                </div>


                                <div class="btn-wrapper mt-0">
                                    <button class="theme-btn-1 btn btn-block" type="submit">
                                        {{ __('Zatwierdź') }}
                                    </button>
                                </div>

                            </form>




                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- LOGIN AREA END -->

        <div class="ltn__utilize-overlay"></div>

        <!-- Laravel Javascript Validation -->
        <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

        {!! JsValidator::formRequest('App\Http\Requests\StoreProductRequest') !!}
    </div>
@endsection

@section('js-files')
    <script src="{{ asset('js/preview_image.js') }}"></script>
@endsection
