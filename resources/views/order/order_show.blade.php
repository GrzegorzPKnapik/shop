@extends('layouts.appwhite')

@section('content')

    <body>


    <!-- Add your site or application content here -->

    <!-- Body main wrapper start -->
    <div class="body-wrapper">

        <!-- BREADCRUMB AREA START -->
        <div
            class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image"
            data-bg="{{asset('img/bg/9.jpg')}}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                            <div class="section-title-area ltn__section-title-2">
                                <h6 class="section-subtitle ltn__secondary-color">// Welcome to our company</h6>
                                <h1 class="section-title white-color">Order preview</h1>
                            </div>
                            <div class="ltn__breadcrumb-list">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li>My Account</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- WISHLIST AREA START -->
        <div class="liton__wishlist-area pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- PRODUCT TAB AREA START -->
                        <div class="ltn__product-tab-area">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="ltn__tab-menu-list mb-50">
                                            <div class="nav">
                                                <a class="active show" data-bs-toggle="tab">Order preview <i
                                                        class="fas fa-file-alt"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="tab-content">

                                            <div class="ltn__myaccount-tab-content-inner">
                                                <p>Podgląd zamówienia</p>
                                                <div class="ltn__form-box">
                                                    <div class="ltn__myaccount-tab-content-inner">
                                                        <div class="table-responsive">

                                                            @foreach($order as $item)
                                                                <p class="text-center">
                                                                    <label>Order ID:</label>
                                                                <h1 class="text-center">#{{$item->id}}</h1>
                                                                <br>
                                                                </p>
                                                                Address:</td>
                                                                <p><strong>{{$item->shopping_list->address->name}} {{{$item->shopping_list->address->surname}}}</strong></p>
                                                                <p>{{$item->shopping_list->address->city}}, {{$item->shopping_list->address->street}}<br>
                                                                    {{$item->shopping_list->address->zip_code}}, {{$item->shopping_list->address->voivodeship}}</p>
                                                                <p>Telefon: {{$item->shopping_list->address->phone_number}}</p>
                                                                @php break;@endphp
                                                            @endforeach

                                                            <br>

                                                            <table class="table text-center caption-top table-sm">
                                                                <caption>Products</caption>
                                                                <thead>
                                                                <tr>
                                                                    <th>Number</th>
                                                                    <th>Image</th>
                                                                    <th>Name</th>
                                                                    <th>Price</th>
                                                                    <th>Quantity</th>
                                                                    <th>SubTotal</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($order as $index => $item)
                                                                    @foreach ($item->shopping_list->shopping_lists_products as $index => $item)
                                                                        <tr>
                                                                            <td class="cart-product-name">{{ $index+1}}.</td>
                                                                            <td class="cart-product-image"> <a href="product-details.html"><img src="{{asset('storage/' . $item->product->image->name)}}" alt="Zdjęcie"></a></td>
                                                                            <td class="cart-product-name">{{$item->product->name}}</td>
                                                                            <td class="cart-product-name">${{$item->product->price}}</td>
                                                                            <td class="cart-product-name">x{{$item->quantity}}</td>
                                                                            <td class="cart-product-subtotal">${{$item->sub_total}}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endforeach
                                                                </tbody>
                                                            </table>

                                                                <p >
                                                                    <label>Ustawiony dzień realizacji cyklicznych dostaw: </label>
                                                                    @foreach($order as $item){{ \Carbon\Carbon::parse($item->shopping_list->delivery_date)->locale('pl')->isoFormat('dddd') }}
                                                                    <br>
                                                                    @php break;@endphp
                                                                    @endforeach
                                                                    <br>
                                                                </p>

                                                            <div class="shoping-cart-total mt-50">
                                                                <h4>Cart Totals</h4>
                                                                <table class="table text-center table-sm">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td>Vat</td>
                                                                        <td>$00.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Order Total</strong></td>
                                                                        <td><strong>$
                                                                                @foreach($order as $item)
                                                                                    {{$item->shopping_list->total}}
                                                                                    @php break;@endphp
                                                                                @endforeach
                                                                            </strong></td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
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
                    <!-- PRODUCT TAB AREA END -->
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- Body main wrapper end -->


    </body>

@endsection

@section('javascript')
    const DATA = {
    editfieldUrl: '{{url('cart')}}/',

    }
@endsection
