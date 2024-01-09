@extends('layouts.appwhite')

@section('content')
<div class="body-wrapper">
    @include('helpers.responses')
    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image" data-bg="public/img/bg_used/2.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                        <div class="section-title-area ltn__section-title-2">
                            <h6 class="section-subtitle ltn__secondary-color">Shopping lists</h6>
                            <h1 class="section-title white-color">Shopping lists</h1>
                        </div>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li>Shopping lists</li>
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
                        <th>Title</th>
                        <th>Newest order number</th>
                        <th>Shopping list number</th>
                        <th>Update date</th>
                        <th>Price</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <!--                                                            //wyswietl tylko te co mają status różny od ordered czyli od resume-->
                    @foreach($shopping_lists as $item)

                        <tr>
                            <td class="cart-product-name">{{$item->title}}</td>
                            @forelse($item->orders as $v => $order)
                                @if(!$order->status->isDelivered())
                                    <td class="cart-product-name">#{{$order->id}}</td>
                                @endif
                            @empty
                                <td class="cart-product-name"></td>
                            @endforelse

                            <td class="cart-product-name">#{{$item->id}}</td>
                            <td class="cart-product-name">{{$item->updated_at}}</td>

                            <td class="cart-product-name">${{$item->total}}</td>
                            <td class="cart-product-name">
                                @if($item->active==true)
                                    {{__('YES')}}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('shoppingList.show', $item->id) }}">
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
    <!-- LOGIN AREA END -->

    <div class="mb-50"></div>

    <div class="ltn__utilize-overlay"></div>

</div>
@endsection


@section('js-files')
@endsection
