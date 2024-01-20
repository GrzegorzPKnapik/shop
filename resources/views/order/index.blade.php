@extends('layouts.appwhite')

@section('content')
<div class="body-wrapper">
    @include('helpers.responses')
    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image" data-bg="img/bg_used/8.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                        <div class="section-title-area ltn__section-title-2">
                            <h6 class="section-subtitle ltn__secondary-color">// witamy w naszym sklepie</h6>
                            <h1 class="section-title white-color">Zamówienia</h1>
                        </div>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="index.html">Start</a></li>
                                <li>Zamówienia</li>
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
                        <th>Numer</th>
                        <th>Numer użytkownika</th>
                        <th>Status</th>
                        <th>Data utworzenia</th>
                        <th>Cena</th>
                        <th>Akcje</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($orders as $item)
                        <tr>

                            <td class="cart-product-name">#{{$item->id}}</td>
                            <td class="cart-product-name">#{{$item->shopping_list->user->id}}</td>
                            <td class="cart-product-name">{{$item->status}}
                                <a href="{{route('order.editStatus', $item->id)}}" role="button" aria-expanded="false" aria-controls="collapseDayPicker">
                                <button class="icon-edit"></button>
                            </a>
                            </td>
                            <td class="cart-product-name">{{$item->created_at}}</td>
                            <td class="cart-product-name">{{ number_format($item->shopping_list->total, 2, ',', ' ') }} zł</td>
                            <td>
                                <a href="{{ route('order.show', $item->id) }}">
                                    <button class="icon-search"></button>
                                </a>
                            </td>

                        </tr>


                    @endforelse
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
