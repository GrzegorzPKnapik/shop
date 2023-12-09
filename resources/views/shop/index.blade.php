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




        <!--    <div class="ltn__utilize-overlay"></div>-->

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
                                        <form id="filterForm" action="{{route('shop.index')}}" method="GET" onchange="SubmitForm('filterForm');">
                                            @csrf
                                            <select name="sort" class="nice-select">
                                                <option value="1" {{ request('sort') == 1 ? 'selected' : '' }}>Default Sorting</option>
                                                <option value="2" {{ request('sort') == 2 ? 'selected' : '' }}>Sort by new arrivals</option>
                                                <option value="3" {{ request('sort') == 3 ? 'selected' : '' }}>Sort by price: low to high</option>
                                                <option value="4" {{ request('sort') == 4 ? 'selected' : '' }}>Sort by price: high to low</option>
                                            </select>






                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!--                    <div id="refreshProducts">-->
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="liton_product_grid">
                                <div class="ltn__product-tab-content-inner ltn__product-grid-view">
                                    <div class="row" id="roww">
                                        <!-- ltn__product-item -->
                                        @foreach($products as $product)
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
                                                                    <a href="" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal_{{ $product->id }}">
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
                                                            <span>${{$product->price}}</span>
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
                        <!--                    </div>-->
                    </div>
                    <div class="col-lg-4">



                        <aside class="sidebar ltn__shop-sidebar ltn__right-sidebar">

                            <div class="widget ">
                                <h4 class="ltn__widget-title ltn__widget-title-border">Search Objects</h4>
                                <!--                        <form id="searchForm" action="{{route('shop.index')}}" method="GET">-->
                                {{--@csrf--}}
                                <input type="text" name="search" value="{{request('search')}}" placeholder="Search your keyword...">
                                <button class="theme-btn-1 btn btn-effect-1"  id="filter_button" type="submit">
                                    <i class="fas fa-search"></i> {{ __('Szukaj') }}
                                </button>
                                <!--                            </form>-->
                            </div>


                            <!-- Price Filter Widget -->
                            <div class="widget ltn__price-filter-widget">
                                <h4 class="ltn__widget-title ltn__widget-title-border">Filter by price</h4>
                                <div class="price_filter">

                                    <input type="text" name="filter[price_min]" value="{{request('filter.price_min')}}" placeholder="Add Your Price" />

                                    <input type="text" name="filter[price_max]" value="{{request('filter.price_max')}}" placeholder="Add Your Price" />

                                </div>
                            </div>

                            <!-- Categories Widget -->
                            <div class="widget ltn__tagcloud-widget">
                                <h4 class="ltn__widget-title ltn__widget-title-border">Categories</h4>
                                <ul>
                                    @foreach($categories as $category)
                                        <li>
                                            <label>
                                                <input type="checkbox" name="filter[categories][]" id="category-{{$category->id}}" value="{{$category->id}}" {{ in_array($category->id, (array)request('filter.categories', [])) ? 'checked' : '' }}>
                                                <label class="tag-label">{{$category->name}}</label>
                                            </label>
                                        </li>
                                    @endforeach
                                    <!-- Dodaj resztę checkboxów zgodnie z powyższym wzorcem -->
                                </ul>
                            </div>



                            <button class="theme-btn-1 btn btn-effect-1" id="filter_button" type="submit">
                                {{ __('Filtruj') }}
                            </button>

                            </form>

                            <button class="theme-btn-2 btn btn-effect-2" onclick="clearFilters()">
                                {{ __('Wyczyść filtry') }}
                            </button>


                        </aside>
                    </div>
                </div>
            </div>
        </div>
        <!-- PRODUCT DETAILS AREA END -->

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
                                                            <a href="product-details.html"><img src="{{asset('storage/' . $product->image->name)}}" alt="Zdjęcie"></a>
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
                                                                <li><label for="valueQuantity">max 99sztuk:</label>
                                                                    <div class="cart-plus-minus">
                                                                        <!--                                                                <input type="text" value="02" name="qtybutton" class="cart-plus-minus-box">-->
                                                                        <input type="number" value="1" name="valueQuantity" id="valueQuantity" class="cart-plus-minus-box" data-id="{{$product->id}}">

                                                                    </div>
                                                                </li>


                                                                <li>
                                                                    <a href="" class="theme-btn-1 btn btn-effect-1 add-to-cart-value" title="Add to Cart" data-id="{{$product->id}}">
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

        <script>
            function clearFilters() {
                // Pobierz aktualny adres URL
                var currentUrl = window.location.href;

                // Usuń parametry z adresu URL
                var cleanUrl = currentUrl.split('?')[0];

                // Zaktualizuj adres URL
                window.location.href = cleanUrl;
            }

            function SubmitForm(formId) {
                var oForm = document.getElementById(formId);
                if (oForm) {
                    oForm.submit();
                }
                else {
                    alert("DEBUG - could not find element " + formId);
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



