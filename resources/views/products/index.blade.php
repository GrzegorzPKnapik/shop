@extends('layouts.app')

@section('content')
<div class="body-wrapper">
    @include('helpers.responses')
    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image" data-bg="img/bg/9.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                        <div class="section-title-area ltn__section-title-2">
                            <h6 class="section-subtitle ltn__secondary-color">Produkty</h6>
                            <h1 class="section-title white-color">Produkty</h1>
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
    <div class="col-lg-6 m-auto">
        <div class="tab-content">
            <div class="table-responsive">
                <table class="table text-center table-sm">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nazwa</th>
                        <th>Akcje</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                    <tr class="delete_mem{{$product->id}}">
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->image->name}}</td>


                        <td>
                        <button class="icon-cancel deleteProduct" data-id="{{$product->id}}"></button>

                            <a href="{{ route('product.edit', $product->id) }}">
                                <button class="icon-edit"></button>
                            </a>

                            <a href="https://www.freecodecamp.org/">
                                <button class="icon-search"></button>
                            </a>

                        <td><a href="cart.html">Quickview</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
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

    <!-- Utilize Cart Menu Start -->
    <div id="ltn__utilize-cart-menu" class="ltn__utilize ltn__utilize-cart-menu">
        <div class="ltn__utilize-menu-inner ltn__scrollbar">
            <div class="ltn__utilize-menu-head">
                <span class="ltn__utilize-menu-title">Cart</span>
                <button class="ltn__utilize-close">×</button>
            </div>
            <div class="mini-cart-product-area ltn__scrollbar">
                <div class="mini-cart-item clearfix">
                    <div class="mini-cart-img">
                        <a href="#"><img src="img/product/1.png" alt="Image"></a>
                        <span class="mini-cart-item-delete"><i class="icon-cancel"></i></span>
                    </div>
                    <div class="mini-cart-info">
                        <h6><a href="#">Red Hot Tomato</a></h6>
                        <span class="mini-cart-quantity">1 x $65.00</span>
                    </div>
                </div>
                <div class="mini-cart-item clearfix">
                    <div class="mini-cart-img">
                        <a href="#"><img src="img/product/2.png" alt="Image"></a>
                        <span class="mini-cart-item-delete"><i class="icon-cancel"></i></span>
                    </div>
                    <div class="mini-cart-info">
                        <h6><a href="#">Vegetables Juices</a></h6>
                        <span class="mini-cart-quantity">1 x $85.00</span>
                    </div>
                </div>
                <div class="mini-cart-item clearfix">
                    <div class="mini-cart-img">
                        <a href="#"><img src="img/product/3.png" alt="Image"></a>
                        <span class="mini-cart-item-delete"><i class="icon-cancel"></i></span>
                    </div>
                    <div class="mini-cart-info">
                        <h6><a href="#">Orange Sliced Mix</a></h6>
                        <span class="mini-cart-quantity">1 x $92.00</span>
                    </div>
                </div>
                <div class="mini-cart-item clearfix">
                    <div class="mini-cart-img">
                        <a href="#"><img src="img/product/4.png" alt="Image"></a>
                        <span class="mini-cart-item-delete"><i class="icon-cancel"></i></span>
                    </div>
                    <div class="mini-cart-info">
                        <h6><a href="#">Orange Fresh Juice</a></h6>
                        <span class="mini-cart-quantity">1 x $68.00</span>
                    </div>
                </div>
            </div>
            <div class="mini-cart-footer">
                <div class="mini-cart-sub-total">
                    <h5>Subtotal: <span>$310.00</span></h5>
                </div>
                <div class="btn-wrapper">
                    <a href="cart.html" class="theme-btn-1 btn btn-effect-1">View Cart</a>
                    <a href="cart.html" class="theme-btn-2 btn btn-effect-2">Checkout</a>
                </div>
                <p>Free Shipping on All Orders Over $100!</p>
            </div>

        </div>
    </div>
    <!-- Utilize Cart Menu End -->

    <!-- Utilize Mobile Menu Start -->
    <!-- Utilize Mobile Menu End -->

    <div class="ltn__utilize-overlay"></div>

</div>
@endsection

@section('javascript')
 const deleteProductUrl = "{{url('product')}}/";
@endsection

@section('js-files')
@endsection
