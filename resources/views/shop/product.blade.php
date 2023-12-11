@extends('layouts.appwhite')

@section('content')
    <style>

        .disabled-link {
            color: #999; /* Ustaw kolor na szary lub inny kolor sugerujący nieaktywność */
            pointer-events: none; /* Wyłącz interakcję z linkiem */
        }

        .disabled-icon {
            opacity: 0.8;
        }
    </style>


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
    <body>


    <!-- Add your site or application content here -->

    <!-- Body main wrapper start -->
    <div class="wrapper">
        @include('helpers.responses')


        <!-- BREADCRUMB AREA START -->
        <div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image" data-bg="">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                            <div class="section-title-area ltn__section-title-2">
                                <h6 class="section-subtitle ltn__secondary-color">//  Welcome to our company</h6>
                                <h1 class="section-title white-color">Product Details</h1>
                            </div>
                            <div class="ltn__breadcrumb-list">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li>Product Details</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BREADCRUMB AREA END -->

        <div class="ltn__shop-details-area pb-85">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="ltn__shop-details-inner mb-60">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="ltn__shop-details-img-gallery">
                                        <div class="ltn__shop-details-large-img">
                                            <div class="single-large-img">
                                                @if(!is_null($product->image->name))
                                                    <a href="{{asset('storage/' . $product->image->name)}}" data-rel="lightcase:myCollection"><img src="{{asset('storage/' . $product->image->name)}}" alt="Zdjęcie"></a>
                                                @else
                                                    <img src="img/product/6.png" alt="Zdjęcie">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="ltn__shop-details-small-img slick-arrow-2">
                                            <div class="single-small-img">
                                                @if(!is_null($product->image->name))
                                                    <a href="{{route('shop.product', $product->id)}}"><img src="{{asset('storage/' . $product->image->name)}}" alt="Zdjęcie"></a>
                                                @else
                                                    <img src="img/product/6.png" alt="Zdjęcie">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="modal-product-info shop-details-info pl-0">
                                        <div class="product-ratting">
                                            <ul>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                                <li class="review-total"> <a href=""> ( 95 Reviews )</a></li>
                                            </ul>
                                        </div>
                                        <h3>{{$product->name}}</h3>
                                        <div class="product-price">
                                            <span>${{$product->price}}</span>
                                            <del>$35.00</del>
                                        </div>
                                        <div class="modal-product-meta ltn__product-details-menu-1">
                                            <ul>
                                                <li>
                                                    <strong>Dostępność:</strong>
                                                    <span>
                                                            {{$product->status->getStatusText()}}
                                                        </span>
                                                </li>
                                                <li>
                                                    <strong>Categories:</strong>
                                                    <span>
                                                            {{$product->category->name}}
                                                        </span>
                                                </li>

                                                @if(isset($product->description->calories))
                                                    <li>
                                                        <strong>Calories:</strong>
                                                        <span>
                                                            {{$product->description->calories}}
                                                        </span>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="ltn__product-details-menu-2">
                                            <ul>

                                                <li>
                                                    <label for="valueQuantity">max 99sztuk:</label>
                                                    <div class="cart-plus-minus m-auto">
                                                        <div class="dec qtybutton" onclick="decrement()">-</div>
                                                        <input type="number" value="1" name="valueQuantity" id="valueQuantity" class="cart-plus-minus-box cart_quantity_input">
                                                        <div class="inc qtybutton" onclick="increment()">+</div>
                                                    </div>
                                                </li>



                                                <li>
                                                    <a href="" title="Add to Cart" class="theme-btn-1 btn btn-effect-1 add-to-cart-value  {{$product->status->isSoldOut() ? 'disabled-icon' : ''}} {{$product->status->isSoldOut() ? 'disabled-link' : ''}}" data-id="{{$product->id}}">
                                                        <i class="fas fa-shopping-cart"></i>
                                                        <span>ADD TO CART</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="ltn__product-details-menu-3">
                                        </div>
                                        <hr>
                                        <div class="ltn__social-media">
                                        </div>
                                        <hr>
                                        <div class="ltn__safe-checkout">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Shop Tab Start -->
                        <div class="ltn__shop-details-tab-inner ltn__shop-details-tab-inner-2">
                            <div class="ltn__shop-details-tab-menu">
                                <div class="nav">
                                    <a class="active show" data-bs-toggle="tab" href="#liton_tab_details_1_1">Description</a>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="liton_tab_details_1_1">
                                    <div class="ltn__shop-details-tab-content-inner">
                                        <h4 class="title-2">{{$product->name}}</h4>
                                        <p>{{$product->description->name}}</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="liton_tab_details_1_2">
                                    <div class="ltn__shop-details-tab-content-inner">
                                        <h4 class="title-2">Customer Reviews</h4>
                                        <div class="product-ratting">
                                            <ul>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                                <li class="review-total"> <a href=""> ( 95 Reviews )</a></li>
                                            </ul>
                                        </div>
                                        <hr>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Shop Tab End -->
                    </div>
                    <div class="col-lg-4">
                        <aside class="sidebar ltn__shop-sidebar ltn__right-sidebar">
                            <!-- Top Rated Product Widget -->

                            <!-- Banner Widget -->
                            <div class="widget ltn__banner-widget">
                                <a href="shop.html"><img src="" alt=""></a>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function increment() {
                var inputElement = document.getElementById('valueQuantity');
                var currentValue = parseInt(inputElement.value, 10);

                if (currentValue < 99) {
                    inputElement.value = currentValue + 1;
                }
            }

            function decrement() {
                var inputElement = document.getElementById('valueQuantity');
                var currentValue = parseInt(inputElement.value, 10);

                if (currentValue > 1) {
                    inputElement.value = currentValue - 1;
                }
            }

        </script>

        @endsection

        @section('javascript')
            const DATA = {
            addToCartUrl: '{{url('cart')}}/',
            cart: '{{ url('cart') }}',
            }
@endsection



