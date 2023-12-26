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
                <div class="mb-4">
                    <a href="{{ route('product.create') }}" class="theme-btn-1 btn btn-effect-1">{{ __('Dodaj nowy produkt') }}</a>
                </div>
                <table class="table text-center table-sm">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Create date</th>
                        <th>Update date</th>
                        <th>Action</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr class="align-middle delete_mem{{$product->id}}">
                            <td class="cart-product-info">
                                <h4><a>#{{$product->id}}</a></h4>
                            </td>

                            <td class="cart-product-image">
                                <a href="product-details.html"><img src="{{asset('storage/' . $product->image->name)}}" alt="Zdjęcie"></a>
                            </td>

                            <td class="cart-product-info">
                                {{$product->name}}
                            </td>
                            <td>
                                {{$product->category->name}}
                            </td>


                            <td class="cart-product-info">
                                ${{$product->price}}
                            </td>
                            <td class="cart-product-info">
                                {{$product->created_at}}
                            </td>
                            <td class="cart-product-info">
                                {{$product->updated_at}}
                            </td>
                            <td>
                                <button class="icon-cancel deleteProduct" data-id="{{$product->id}}"></button>

                                <a href="{{ route('product.edit', $product->id) }}">
                                    <button class="icon-edit"></button>
                                </a>

                                <a href="{{ route('product.show', $product->id) }}">
                                    <button class="icon-search"></button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="ltn__pagination-area text-center" id="refreshPagination">
        <div class="ltn__pagination">

                                        <ul>
                                               @if ($products->currentPage() > 1)
                                                    <li><a href="{{ $products->previousPageUrl() }}" rel="prev"><i class="fas fa-angle-double-left leftArrow" data-id="{{$products->previousPageUrl()}}"></i></a></li>
                                                @endif


                @for ($i = 1; $i <= $products->lastPage(); $i++)
                    <li class="{{ ($i == $products->currentPage()) ? 'active' : '' }}">
                        <a href="{{ $products->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                                                @if ($products->currentPage() < $products->lastPage())
                                                   <li><a href="{{ $products->nextPageUrl() }}" rel="next"><i class="fas fa-angle-double-right"></i></a></li>
                                                @endif
            </ul>
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
