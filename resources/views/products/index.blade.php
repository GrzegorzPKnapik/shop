@extends('layouts.appwhite')

@section('content')
<div class="body-wrapper">
    @include('helpers.responses')
    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image" data-bg="img/bg_used/2.jpg">
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


    <div class="mb-50"></div>


    <div class="ltn__utilize-overlay"></div>

</div>
@endsection

@section('javascript')
 const deleteProductUrl = "{{url('product')}}/";
@endsection

@section('js-files')
@endsection
