@extends('layouts.appwhite')

@section('content')
    <style>
        /* Dostosuj rozmiar checkboxa */
        .btn-check {
            width: 1rem;
            height: 1rem;
        }

        /* Dostosuj rozmiar etykiety */
        .btn-outline-secondary {
            font-size: 0.8rem; /* Dostosuj wielkość czcionki według własnych preferencji */
            padding: 0.2rem 0.5rem; /* Dostosuj wypełnienie według własnych preferencji */
        }
    </style>
    <body>


    <!-- Add your site or application content here -->

    <!-- Body main wrapper start -->
    <div class="wrapper">
        @include('helpers.responses')




    <div class="ltn__utilize-overlay"></div>

    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area ltn__breadcrumb-area-3 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image plr--9---" data-bg="img/bg/9.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                        <div class="section-title-area ltn__section-title-2">
                            <h6 class="section-subtitle ltn__secondary-color">//  Welcome to our company</h6>
                            <h1 class="section-title white-color">Shop</h1>
                        </div>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li>Shop</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->

    <!-- PRODUCT DETAILS AREA START -->
    <div class="ltn__product-area ltn__product-gutter mb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="ltn__shop-options">
                        <ul>
                            <li>
                                <div class="ltn__grid-list-tab-menu ">
                                    <div class="nav">
                                        <a class="active show" data-bs-toggle="tab" href="#liton_product_grid"><i class="fas fa-th-large"></i></a>
                                        <a data-bs-toggle="tab" href="#liton_product_list"><i class="fas fa-list"></i></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                               <div class="showing-product-number text-right text-end">
                                    <span>Showing 1–12 of 18 results</span>
                                </div>
                            </li>
                            <li>
                               <div class="short-by text-center">
                                   <form action="{{route('shop.index')}}" method="GET">
                                       @csrf
                                       <select name="select" class="nice-select">

                                           <option value="1" {{ $sort_select == 1 ? 'selected' : '' }}>Default Sorting</option>
                                           <option value="2" {{ $sort_select == 2 ? 'selected' : '' }}>Sort by new arrivals</option>
                                           <option value="3" {{ $sort_select == 3 ? 'selected' : '' }}>Sort by price: low to high</option>
                                           <option value="4" {{ $sort_select == 4 ? 'selected' : '' }}>Sort by price: high to low</option>
                                       </select>

                                       <button class="theme-btn-1 btn btn-effect-1 saveFil" type="submit">
                                           {{ __('Save changes') }}
                                       </button>
                                   </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div id="refreshProducts">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="liton_product_grid">
                            <div class="ltn__product-tab-content-inner ltn__product-grid-view">
                                <div class="row" id="roww">
                                    <!-- ltn__product-item -->
                                    @foreach($products as $product)
                                        {{ $sort_select}}
                                                                            <div class="col-xl-4 col-sm-6 col-6">
                                                                                <div class="ltn__product-item ltn__product-item-3 text-center">
                                                                                    <div class="product-img">

                                                                                        @if(!is_null($product->image->name))
                                                                                            <a href="product-details.html"><img src="{{asset('storage/' . $product->image->name)}}" alt="Zdjęcie"></a>
                                                @else
                                                    <img src="img/product/6.png" alt="Zdjęcie">
                                                @endif
                                                <div class="product-badge">
                                                    <ul>
                                                        <li class="sale-badge">New</li>
                                                    </ul>
                                                </div>
                                                <div class="product-hover-action">
                                                    <ul>
                                                        <li>
                                                            <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                                                <i class="far fa-eye"></i>
                                                            </a>
                                                        </li>


                                                        <li>
                                                            <a href="" title="Add to Cart" class="add-to-cart" data-id="{{$product->id}}">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        </li>




                                                        <li>
                                                            <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                                                <i class="far fa-heart"></i></a>
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
                                                    <span>${{$product->price}}.00</span>
                                                    <del>$35.00</del>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach
                                </div>
                                    <!--  -->
                                </div>
                            </div>
                        </div>

                    <div class="ltn__pagination-area text-center" id="refreshPagination">
                        <div class="ltn__pagination">

<!--                            <ul class="pag">-->
                                <ul>
{{--                                @if ($products->currentPage() > 1)--}}
{{--                                    <li><a href="{{ $products->previousPageUrl() }}" rel="prev"><i class="fas fa-angle-double-left leftArrow" data-id="{{$products->previousPageUrl()}}"></i></a></li>--}}
{{--                                @endif--}}


                                @for ($i = 1; $i <= $products->lastPage(); $i++)
                                    <li class="{{ ($i == $products->currentPage()) ? 'active' : '' }}">
                                        <a href="{{ $products->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

{{--                                @if ($products->currentPage() < $products->lastPage())--}}
{{--                                    <li><a href="{{ $products->nextPageUrl() }}" rel="next"><i class="fas fa-angle-double-right"></i></a></li>--}}
{{--                                @endif--}}
                            </ul>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <aside class="sidebar ltn__shop-sidebar ltn__right-sidebar">
                        <form  action="{{route('shop.index')}}" method="GET">
                        <!-- Category Widget -->
                        <div class="widget ltn__menu-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Product categories</h4>
                            <ul>
                                <li><a href="#">Body <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                                <li><a href="#">Interior <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                                <li><a href="#">Lights <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                                <li><a href="#">Parts <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                                <li><a href="#">Tires <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                                <li><a href="#">Uncategorized <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                                <li><a href="#">Wheel <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                            </ul>
                        </div>
                        <!-- Price Filter Widget -->
                        <div class="widget ltn__price-filter-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Filter by price</h4>
                            <div class="price_filter">

                                <input type="text" name="filter[price_min]" value="{{request()->input('filter.price_min')}}" placeholder="Add Your Price" />

                                <input type="text" name="filter[price_max]" value="{{request()->input('filter.price_max')}}" placeholder="Add Your Price" />

                            </div>
                        </div>

                        <!-- Search Widget -->
<!--                        <div class="widget ltn__search-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Search Objects</h4>
                            <form action="{{ route('shop.index') }}" method="GET">
                                @csrf
                                <input type="text" name="search" placeholder="Search your keyword...">
                                <button type="submit" class="search"><i class="fas fa-search"></i></button>
                            </form>
                        </div>-->
                        <!-- Tagcloud Widget -->
                            <div class="widget ltn__tagcloud-widget">
                                <h4 class="ltn__widget-title ltn__widget-title-border">Popular Tags</h4>
                                <ul>
                                    @foreach($categories as $category)
                                    <li>
                                        <label>
                                            <input type="checkbox" name="filter[categories][]" id="category-{{$category->id}}" value="{{$category->id}}" {{ in_array($category->id, (array)request()->input('filter.categories', [])) ? 'checked' : '' }}>
                                            <label class="tag-label">{{$category->name}}</label>
                                        </label>
                                    </li>
                                    @endforeach
                                    <!-- Dodaj resztę checkboxów zgodnie z powyższym wzorcem -->
                                </ul>
                            </div>

                        <!-- Size Widget -->
                        <div class="widget ltn__tagcloud-widget ltn__size-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Product Size</h4>
                            <ul>
                                <li><a href="#">M</a></li>
                                <li><a href="#">L</a></li>
                                <li><a href="#">XL</a></li>
                                <li><a href="#">XXL</a></li>
                            </ul>
                        </div>
                        <!-- Color Widget -->
                        <div class="widget ltn__color-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Product Color</h4>
                            <ul>
                                <li class="black"><a href="#"></a></li>
                                <li class="white"><a href="#"></a></li>
                                <li class="red"><a href="#"></a></li>
                                <li class="silver"><a href="#"></a></li>
                                <li class="gray"><a href="#"></a></li>
                                <li class="maroon"><a href="#"></a></li>
                                <li class="yellow"><a href="#"></a></li>
                                <li class="olive"><a href="#"></a></li>
                                <li class="lime"><a href="#"></a></li>
                                <li class="green"><a href="#"></a></li>
                                <li class="aqua"><a href="#"></a></li>
                                <li class="teal"><a href="#"></a></li>
                                <li class="blue"><a href="#"></a></li>
                                <li class="navy"><a href="#"></a></li>
                                <li class="fuchsia"><a href="#"></a></li>
                                <li class="purple"><a href="#"></a></li>
                                <li class="pink"><a href="#"></a></li>
                                <li class="nude"><a href="#"></a></li>
                                <li class="orange"><a href="#"></a></li>

                                <li><a href="#" class="orange"></a></li>
                                <li><a href="#" class="orange"></a></li>
                            </ul>
                        </div>
                        <!-- Banner Widget -->
                        <div class="widget ltn__banner-widget">
                            <a href="shop.html"><img src="img/banner/banner-2.jpg" alt="#"></a>
                        </div>

                        <button class="theme-btn-1 btn btn-effect-1" id="filter_button" type="submit">
                            {{ __('Filtruj') }}
                        </button>
                        </form>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- PRODUCT DETAILS AREA END -->



    <!-- MODAL AREA START (Quick View Modal) -->
    <div class="ltn__modal-area ltn__quick-view-modal-area">
        <div class="modal fade" id="quick_view_modal" tabindex="-1">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <!-- <i class="fas fa-times"></i> -->
                        </button>
                    </div>
                    <div class="modal-body">
                         <div class="ltn__quick-view-modal-inner">
                             <div class="modal-product-item">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="modal-product-img">
                                            <img src="img/product/4.png" alt="#">
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
                                            <h3>Vegetables Juices</h3>
                                            <div class="product-price">
                                                <span>$149.00</span>
                                                <del>$165.00</del>
                                            </div>
                                            <div class="modal-product-meta ltn__product-details-menu-1">
                                                <ul>
                                                    <li>
                                                        <strong>Categories:</strong>
                                                        <span>
                                                            <a href="#">Parts</a>
                                                            <a href="#">Car</a>
                                                            <a href="#">Seat</a>
                                                            <a href="#">Cover</a>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="ltn__product-details-menu-2">
                                                <ul>
                                                    <li>
                                                        <div class="cart-plus-minus">
                                                            <input type="text" value="02" name="qtybutton" class="cart-plus-minus-box">
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="theme-btn-1 btn btn-effect-1" title="Add to Cart" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
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



        @endsection

        @section('javascript')
            const DATA = {
            addToCartUrl: '{{url('cart')}}/',
            cart: '{{ url('cart') }}',
            }
@endsection



