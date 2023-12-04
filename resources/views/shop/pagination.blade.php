
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="liton_product_grid">
                            <div class="ltn__product-tab-content-inner ltn__product-grid-view">
                                <div class="row">
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

                            <ul class="pag">
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
