@extends('layouts.appwhite')


@section('content')

    <style>
        /* Dostosuj rozmiar etykiety */
        .btn-outline-secondary {
            font-size: 0.8rem; /* Dostosuj wielkość czcionki według własnych preferencji */
            padding: 0.2rem 0.5rem; /* Dostosuj wypełnienie według własnych preferencji */
        }

        .disabled-link {
            color: #999; /* Ustaw kolor na szary lub inny kolor sugerujący nieaktywność */
            pointer-events: none; /* Wyłącz interakcję z linkiem */
        }

        .disabled-icon {
            opacity: 0.5;
        }

    </style>

    <!-- Body main wrapper start -->
    <div class="body-wrapper">

        @include('helpers.responses')
        <!-- Utilize Mobile Menu Start -->
        <!-- Utilize Mobile Menu End -->


        <!-- SLIDER AREA START (slider-3) -->
        <div class="ltn__slider-area ltn__slider-3  section-bg-1">
            <div class="ltn__slide-one-active slick-slide-arrow-1 slick-slide-dots-1">
                <!-- ltn__slide-item -->
                <div class="ltn__slide-item ltn__slide-item-2 ltn__slide-item-3 ltn__slide-item-3-normal">
                    <div class="ltn__slide-item-inner">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 align-self-center">
                                    <div class="slide-item-info">
                                        <div class="slide-item-info-inner ltn__slide-animation">
                                            <div class="slide-video mb-50 d-none">
                                                <a class="ltn__video-icon-2 ltn__video-icon-2-border" href="https://www.youtube.com/embed/ATI7vfCgwXE?autoplay=1&showinfo=0" data-rel="lightcase:myCollection">
                                                    <i class="fa fa-play"></i>
                                                </a>
                                            </div>
                                            <h6 class="slide-sub-title animated"><img src="img/icons/icon-img/1.png" alt="#"> 100% genuine Products</h6>
                                            <h1 class="slide-title animated ">Our Garden's  Most <br>   Favorite Food</h1>
                                            <div class="slide-brief animated">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                                            </div>
                                            <div class="btn-wrapper animated">
                                                <a href="shop.html" class="theme-btn-1 btn btn-effect-1 text-uppercase">Explore Products</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slide-item-img">
                                        <img src="img/bg_used/1.png" alt="#">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ltn__slide-item -->
                <div class="ltn__slide-item ltn__slide-item-2 ltn__slide-item-3 ltn__slide-item-3-normal">
                    <div class="ltn__slide-item-inner  text-right text-end">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 align-self-center">
                                    <div class="slide-item-info">
                                        <div class="slide-item-info-inner ltn__slide-animation">
                                            <h6 class="slide-sub-title ltn__secondary-color animated">// TALENTED ENGINEER & MECHANICS</h6>
                                            <h1 class="slide-title animated ">Tasty & Healthy <br>  Organic Food</h1>
                                            <div class="slide-brief animated">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                                            </div>
                                            <div class="btn-wrapper animated">
                                                <a href="shop.html" class="theme-btn-1 btn btn-effect-1 text-uppercase">Explore Products</a>
                                                <a href="about.html" class="btn btn-transparent btn-effect-3">LEARN MORE</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slide-item-img slide-img-left">
                                        <img src="img/bg_used/3.png" alt="#">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
            </div>
        </div>
        <!-- SLIDER AREA END -->

        <!-- FEATURE AREA START ( Feature - 3) -->
        <div class="ltn__feature-area mt-100 mt--65">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__feature-item-box-wrap ltn__feature-item-box-wrap-2 ltn__border section-bg-6">
                            <div class="ltn__feature-item ltn__feature-item-8">
                                <div class="ltn__feature-icon">
                                    <img src="img/icons/svg/8-trolley.svg" alt="#">
                                </div>
                                <div class="ltn__feature-info">
                                    <h4>Free shipping</h4>
                                    <p>On all orders over $49.00</p>
                                </div>
                            </div>
                            <div class="ltn__feature-item ltn__feature-item-8">
                                <div class="ltn__feature-icon">
                                    <img src="img/icons/svg/9-money.svg" alt="#">
                                </div>
                                <div class="ltn__feature-info">
                                    <h4>15 days returns</h4>
                                    <p>Moneyback guarantee</p>
                                </div>
                            </div>
                            <div class="ltn__feature-item ltn__feature-item-8">
                                <div class="ltn__feature-icon">
                                    <img src="img/icons/svg/10-credit-card.svg" alt="#">
                                </div>
                                <div class="ltn__feature-info">
                                    <h4>Secure checkout</h4>
                                    <p>Protected by Paypal</p>
                                </div>
                            </div>
                            <div class="ltn__feature-item ltn__feature-item-8">
                                <div class="ltn__feature-icon">
                                    <img src="img/icons/svg/11-gift-card.svg" alt="#">
                                </div>
                                <div class="ltn__feature-info">
                                    <h4>Offer & gift here</h4>
                                    <p>On all orders over</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FEATURE AREA END -->


        <!-- PRODUCT TAB AREA START (product-item-3) -->
        <div class="ltn__product-tab-area ltn__product-gutter pt-115 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title-area ltn__section-title-2 text-center">
                            <h1 class="section-title">Our Products</h1>
                        </div>
                        <div class="ltn__tab-menu ltn__tab-menu-2 ltn__tab-menu-top-right-- text-uppercase text-center">
                            <div class="nav">
                                <a class="active show" data-bs-toggle="tab" href="#liton_tab_3_1">Wszystko</a>
                                <a data-bs-toggle="tab" href="#liton_tab_3_2" class="">Warzywa</a>
                                <a data-bs-toggle="tab" href="#liton_tab_3_3" class="">Napoje</a>
                                <a data-bs-toggle="tab" href="#liton_tab_3_4" class="">Pieczywo</a>
                                <a data-bs-toggle="tab" href="#liton_tab_3_5" class="">Nabiał</a>
                                <a data-bs-toggle="tab" href="#liton_tab_3_6" class="">Mięsa</a>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="liton_tab_3_1">
                                <div class="ltn__product-tab-content-inner">
                                    <div class="row ltn__tab-product-slider-one-active slick-arrow-1">

                                        <!-- ltn__product-item -->
                                        @foreach($products as $product)
                                        <div class="col-lg-12">
                                            <div class="ltn__product-item ltn__product-item-3 text-center">
                                                <div class="product-img">
                                                    @if(!is_null($product->image->name))
                                                        <a href="{{route('shop.product', $product->id)}}"><img class="{{$product->status->isSoldOut() ? 'disabled-icon' : ''}}" src="{{asset('storage/' . $product->image->name)}}" alt="Zdjęcie"></a>
                                                    @else
                                                        <img src="img/product/6.png" alt="Zdjęcie">
                                                    @endif
                                                    @if(!$product->status->isEnable())
                                                            <div class="product-badge">
                                                                <ul>
                                                                    <li class="sale-badge">{{$product->status->isSoldOut() ? $product->status->getStatusText() : \App\Enums\ProductStatus::DISABLE}}</li>
                                                                </ul>
                                                            </div>
                                                    @endif
                                                    <div class="product-hover-action">
                                                        <ul>
                                                            <li>
                                                                <a href="" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal_{{ $product->id }}">
                                                                    <i class="far fa-eye"></i>
                                                                </a>
                                                            </li>




                                                            <li>
                                                                <a href="" title="Add to Cart" class="add-to-cart {{$product->status->isSoldOut() ? 'disabled-icon' : ''}} {{$product->status->isSoldOut() ? 'disabled-link' : ''}}" data-id="{{$product->id}}">
                                                                <i class="fas fa-shopping-cart"></i>
                                                                </a>
                                                            </li>


                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product-info">
                                                    <div class="product-ratting">
                                                        <ul>
                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <h2 class="product-title"><a href="product-details.html">{{$product->name}}</a></h2>
                                                    <div class="product-price">
                                                        <span>${{$product->price}}</span>
                                                        <del>$35.00</del>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach



                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="liton_tab_3_2">
                                <div class="ltn__product-tab-content-inner">
                                    <div class="row ltn__tab-product-slider-one-active slick-arrow-1">
                                        <!-- ltn__product-item -->
                                        @foreach($vegetablesProducts as $product)
                                            <div class="col-lg-12">
                                                <div class="ltn__product-item ltn__product-item-3 text-center">
                                                    <div class="product-img">
                                                        @if(!is_null($product->image->name))
                                                            <a href="{{route('shop.product', $product->id)}}"><img class="{{$product->status->isSoldOut() ? 'disabled-icon' : ''}}" src="{{asset('storage/' . $product->image->name)}}" alt="Zdjęcie"></a>
                                                        @else
                                                            <img src="img/product/6.png" alt="Zdjęcie">
                                                        @endif
                                                        @if(!$product->status->isEnable())
                                                            <div class="product-badge">
                                                                <ul>
                                                                    <li class="sale-badge">{{$product->status->isSoldOut() ? $product->status->getStatusText() : \App\Enums\ProductStatus::DISABLE}}</li>
                                                                </ul>
                                                            </div>
                                                        @endif
                                                        <div class="product-hover-action">
                                                            <ul>
                                                                <li>
                                                                    <a href="" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal_{{ $product->id }}">
                                                                        <i class="far fa-eye"></i>
                                                                    </a>
                                                                </li>


                                                                <li>
                                                                    <a href="" title="Add to Cart" class="add-to-cart {{$product->status->isSoldOut() ? 'disabled-icon' : ''}} {{$product->status->isSoldOut() ? 'disabled-link' : ''}}" data-id="{{$product->id}}">
                                                                        <i class="fas fa-shopping-cart"></i>
                                                                    </a>
                                                                </li>



                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="product-info">
                                                        <div class="product-ratting">
                                                            <ul>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <h2 class="product-title"><a href="product-details.html">{{$product->name}}</a></h2>
                                                        <div class="product-price">
                                                            <span>${{$product->price}}</span>
                                                            <del>$35.00</del>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="liton_tab_3_3">
                                <div class="ltn__product-tab-content-inner">
                                    <div class="row ltn__tab-product-slider-one-active slick-arrow-1">
                                        <!-- ltn__product-item -->
                                        @foreach($drinksProducts as $product)
                                            <div class="col-lg-12">
                                                <div class="ltn__product-item ltn__product-item-3 text-center">
                                                    <div class="product-img">
                                                        @if(!is_null($product->image->name))
                                                            <a href="{{route('shop.product', $product->id)}}"><img class="{{$product->status->isSoldOut() ? 'disabled-icon' : ''}}" src="{{asset('storage/' . $product->image->name)}}" alt="Zdjęcie"></a>
                                                        @else
                                                            <img src="img/product/6.png" alt="Zdjęcie">
                                                        @endif
                                                        @if(!$product->status->isEnable())
                                                            <div class="product-badge">
                                                                <ul>
                                                                    <li class="sale-badge">{{$product->status->isSoldOut() ? $product->status->getStatusText() : \App\Enums\ProductStatus::DISABLE}}</li>
                                                                </ul>
                                                            </div>
                                                        @endif
                                                        <div class="product-hover-action">
                                                            <ul>
                                                                <li>
                                                                    <a href="" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal_{{ $product->id }}">
                                                                        <i class="far fa-eye"></i>
                                                                    </a>
                                                                </li>


                                                                <li>
                                                                    <a href="" title="Add to Cart" class="add-to-cart {{$product->status->isSoldOut() ? 'disabled-icon' : ''}} {{$product->status->isSoldOut() ? 'disabled-link' : ''}}" data-id="{{$product->id}}">
                                                                        <i class="fas fa-shopping-cart"></i>
                                                                    </a>
                                                                </li>



                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="product-info">
                                                        <div class="product-ratting">
                                                            <ul>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <h2 class="product-title"><a href="product-details.html">{{$product->name}}</a></h2>
                                                        <div class="product-price">
                                                            <span>${{$product->price}}</span>
                                                            <del>$35.00</del>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="liton_tab_3_4">
                                <div class="ltn__product-tab-content-inner">
                                    <div class="row ltn__tab-product-slider-one-active slick-arrow-1">
                                        <!-- ltn__product-item -->
                                        @foreach($breadStuffProducts as $product)
                                            <div class="col-lg-12">
                                                <div class="ltn__product-item ltn__product-item-3 text-center">
                                                    <div class="product-img">
                                                        @if(!is_null($product->image->name))
                                                            <a href="{{route('shop.product', $product->id)}}"><img class="{{$product->status->isSoldOut() ? 'disabled-icon' : ''}}" src="{{asset('storage/' . $product->image->name)}}" alt="Zdjęcie"></a>
                                                        @else
                                                            <img src="img/product/6.png" alt="Zdjęcie">
                                                        @endif
                                                        @if(!$product->status->isEnable())
                                                            <div class="product-badge">
                                                                <ul>
                                                                    <li class="sale-badge">{{$product->status->isSoldOut() ? $product->status->getStatusText() : \App\Enums\ProductStatus::DISABLE}}</li>
                                                                </ul>
                                                            </div>
                                                        @endif
                                                        <div class="product-hover-action">
                                                            <ul>
                                                                <li>
                                                                    <a href="" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal_{{ $product->id }}">
                                                                        <i class="far fa-eye"></i>
                                                                    </a>
                                                                </li>


                                                                <li>
                                                                    <a href="" title="Add to Cart" class="add-to-cart {{$product->status->isSoldOut() ? 'disabled-icon' : ''}} {{$product->status->isSoldOut() ? 'disabled-link' : ''}}" data-id="{{$product->id}}">
                                                                        <i class="fas fa-shopping-cart"></i>
                                                                    </a>
                                                                </li>



                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="product-info">
                                                        <div class="product-ratting">
                                                            <ul>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <h2 class="product-title"><a href="product-details.html">{{$product->name}}</a></h2>
                                                        <div class="product-price">
                                                            <span>${{$product->price}}</span>
                                                            <del>$35.00</del>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="liton_tab_3_5">
                                <div class="ltn__product-tab-content-inner">
                                    <div class="row ltn__tab-product-slider-one-active slick-arrow-1">
                                        <!-- ltn__product-item -->
                                        @foreach($dairyProducts as $product)
                                            <div class="col-lg-12">
                                                <div class="ltn__product-item ltn__product-item-3 text-center">
                                                    <div class="product-img">
                                                        @if(!is_null($product->image->name))
                                                            <a href="{{route('shop.product', $product->id)}}"><img class="{{$product->status->isSoldOut() ? 'disabled-icon' : ''}}" src="{{asset('storage/' . $product->image->name)}}" alt="Zdjęcie"></a>
                                                        @else
                                                            <img src="img/product/6.png" alt="Zdjęcie">
                                                        @endif
                                                        @if(!$product->status->isEnable())
                                                            <div class="product-badge">
                                                                <ul>
                                                                    <li class="sale-badge">{{$product->status->isSoldOut() ? $product->status->getStatusText() : \App\Enums\ProductStatus::DISABLE}}</li>
                                                                </ul>
                                                            </div>
                                                        @endif
                                                        <div class="product-hover-action">
                                                            <ul>
                                                                <li>
                                                                    <a href="" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal_{{ $product->id }}">
                                                                        <i class="far fa-eye"></i>
                                                                    </a>
                                                                </li>


                                                                <li>
                                                                    <a href="" title="Add to Cart" class="add-to-cart {{$product->status->isSoldOut() ? 'disabled-icon' : ''}} {{$product->status->isSoldOut() ? 'disabled-link' : ''}}" data-id="{{$product->id}}">
                                                                        <i class="fas fa-shopping-cart"></i>
                                                                    </a>
                                                                </li>




                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="product-info">
                                                        <div class="product-ratting">
                                                            <ul>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <h2 class="product-title"><a href="product-details.html">{{$product->name}}</a></h2>
                                                        <div class="product-price">
                                                            <span>${{$product->price}}</span>
                                                            <del>$35.00</del>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="liton_tab_3_6">
                                <div class="ltn__product-tab-content-inner">
                                    <div class="row ltn__tab-product-slider-one-active slick-arrow-1">
                                        <!-- ltn__product-item -->
                                        @foreach($meatProducts as $product)
                                            <div class="col-lg-12">
                                                <div class="ltn__product-item ltn__product-item-3 text-center">
                                                    <div class="product-img">
                                                        @if(!is_null($product->image->name))
                                                            <a href="{{route('shop.product', $product->id)}}"><img class="{{$product->status->isSoldOut() ? 'disabled-icon' : ''}}" src="{{asset('storage/' . $product->image->name)}}" alt="Zdjęcie"></a>
                                                        @else
                                                            <img src="img/product/6.png" alt="Zdjęcie">
                                                        @endif
                                                        @if(!$product->status->isEnable())
                                                            <div class="product-badge">
                                                                <ul>
                                                                    <li class="sale-badge">{{$product->status->isSoldOut() ? $product->status->getStatusText() : \App\Enums\ProductStatus::DISABLE}}</li>
                                                                </ul>
                                                            </div>
                                                        @endif
                                                        <div class="product-hover-action">
                                                            <ul>
                                                                <li>
                                                                    <a href="" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal_{{ $product->id }}">
                                                                        <i class="far fa-eye"></i>
                                                                    </a>
                                                                </li>


                                                                <li>
                                                                    <a href="" title="Add to Cart" class="add-to-cart {{$product->status->isSoldOut() ? 'disabled-icon' : ''}} {{$product->status->isSoldOut() ? 'disabled-link' : ''}}" data-id="{{$product->id}}">
                                                                        <i class="fas fa-shopping-cart"></i>
                                                                    </a>
                                                                </li>




                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="product-info">
                                                        <div class="product-ratting">
                                                            <ul>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                                            </ul>
                                                        </div>
                                                        <h2 class="product-title"><a href="product-details.html">{{$product->name}}</a></h2>
                                                        <div class="product-price">
                                                            <span>${{$product->price}}</span>
                                                            <del>$35.00</del>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- PRODUCT TAB AREA END -->

        <!-- COUNTER UP AREA START -->
        <div class="ltn__counterup-area bg-image bg-overlay-theme-black-80 pt-115 pb-70" data-bg="img/bg_used/4.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6 align-self-center">
                        <div class="ltn__counterup-item-3 text-color-white text-center">
                            <div class="counter-icon"> <img src="img/icons/icon-img/2.png" alt="#"> </div>
                            <h1><span class="counter">15</span><span class="counterUp-letter">K</span><span class="counterUp-icon">+</span> </h1>
                            <h6>Active Clients</h6>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 align-self-center">
                        <div class="ltn__counterup-item-3 text-color-white text-center">
                            <div class="counter-icon"> <img src="img/icons/icon-img/3.png" alt="#"> </div>
                            <h1><span class="counter">33</span><span class="counterUp-letter">K</span><span class="counterUp-icon">+</span> </h1>
                            <h6>Deliveries</h6>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 align-self-center">
                        <div class="ltn__counterup-item-3 text-color-white text-center">
                            <div class="counter-icon"> <img src="img/icons/icon-img/4.png" alt="#"> </div>
                            <h1><span class="counter">10</span><span class="counterUp-icon">+</span> </h1>
                            <h6>Get Rewards</h6>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 align-self-center">
                        <div class="ltn__counterup-item-3 text-color-white text-center">
                            <div class="counter-icon"> <img src="img/icons/icon-img/5.png" alt="#"> </div>
                            <h1><span class="counter">3</span><span class="counterUp-icon">+</span> </h1>
                            <h6>Country Cover</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- COUNTER UP AREA END -->



        <!-- CALL TO ACTION START (call-to-action-4) -->
        <div class="ltn__call-to-action-area ltn__call-to-action-4 bg-image pt-115 pb-120" data-bg="img/bg_used/6.png">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="call-to-action-inner call-to-action-inner-4 text-center">
                            <div class="section-title-area ltn__section-title-2">
                                <h6 class="section-subtitle ltn__secondary-color">//  any question you have  //</h6>
                                <h1 class="section-title white-color">897-876-987-90</h1>
                            </div>
                            <div class="btn-wrapper">
                                <a href="tel:+123456789" class="theme-btn-1 btn btn-effect-1">MAKE A CALL</a>
                                <a href="contact.blade.php" class="btn btn-transparent btn-effect-4 white-color">CONTACT US</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ltn__call-to-4-img-1">
                <img src="img/bg_used/5.png" alt="#">
            </div>

        </div>
        <!-- CALL TO ACTION END -->



        <!-- FEATURE AREA START ( Feature - 3) -->
        <div class="ltn__feature-area before-bg-bottom-2-- mb--30--- plr--5 mb-120">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__feature-item-box-wrap ltn__border-between-column white-bg">
                            <div class="row">
                                <div class="col-xl-3 col-md-6 col-12">
                                    <div class="ltn__feature-item ltn__feature-item-8">
                                        <div class="ltn__feature-icon">
                                            <img src="img/icons/icon-img/11.png" alt="#">
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
                                            <img src="img/icons/icon-img/12.png" alt="#">
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
                                            <img src="img/icons/icon-img/13.png" alt="#">
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
                                            <img src="img/icons/icon-img/14.png" alt="#">
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

        <div id="refreshQV">
            @foreach($products as $product)
                <!-- MODAL AREA START (Quick View Modal) -->
                <div class="ltn__modal-area ltn__quick-view-modal-area">
                    <div class="modal fade" id="quick_view_modal_{{ $product->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" id="closeQV_{{ $product->id }}" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"></span>
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="ltn__quick-view-modal-inner">
                                        <div class="modal-product-item">
                                            <div class="row">
                                                <div class="col-lg-6 col-12">
                                                    <div class="modal-product-img">
                                                        @if(!is_null($product->image->name))
                                                            <a href="{{route('shop.product', $product->id)}}"><img src="{{asset('storage/' . $product->image->name)}}" alt="Zdjęcie"></a>
                                                        @else
                                                            <img src="img/product/6.png" alt="Zdjęcie">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="modal-product-info">
                                                        <div class="product-ratting">
                                                            <ul>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                <li class="review-total"> <a href="#"> ( 95 Reviews )</a></li>
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
                                                            <ul>
                                                                <li>
                                                                    <a href="#" class="" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                                                        <i class="far fa-heart"></i>
                                                                        <span>Add to Wishlist</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#" class="" title="Compare" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                                                        <i class="fas fa-exchange-alt"></i>
                                                                        <span>Compare</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <hr>
                                                        <div class="ltn__social-media">
                                                            <ul>
                                                                <li>Share:</li>
                                                                <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                                                <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                                                <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                                                                <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- MODAL AREA END -->
            @endforeach
        </div>



        <!-- MODAL AREA START (Wishlist Modal) -->
        <div class="ltn__modal-area ltn__add-to-cart-modal-area">
            <div class="modal fade" id="liton_wishlist_modal" tabindex="-1">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="ltn__quick-view-modal-inner">
                                <div class="modal-product-item">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="modal-product-img">
                                                <img src="img/product/7.png" alt="#">
                                            </div>
                                            <div class="modal-product-info">
                                                <h5><a href="product-details.html">Vegetables Juices</a></h5>
                                                <p class="added-cart"><i class="fa fa-check-circle"></i>  Successfully added to your Wishlist</p>
                                                <div class="btn-wrapper">
                                                    <a href="wishlist.html" class="theme-btn-1 btn btn-effect-1">View Wishlist</a>
                                                </div>
                                            </div>
                                            <!-- additional-info -->
                                            <div class="additional-info d-none">
                                                <p>We want to give you <b>10% discount</b> for your first order, <br>  Use discount code at checkout</p>
                                                <div class="payment-method">
                                                    <img src="img/icons/payment.png" alt="#">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL AREA END -->

    </div>
    <!-- Body main wrapper end -->

    <!-- preloader area start -->
    <div class="preloader d-none" id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div>
    <!-- preloader area end -->


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
@section('js-files')
@endsection
