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
                                <h1 class="section-title white-color">Shopping list preview</h1>
                            </div>
                            <div class="ltn__breadcrumb-list">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li>Shopping list</li>
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
                                                <a class="active show" data-bs-toggle="tab">Shopping list<i
                                                        class="fas fa-file-alt"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <div class="tab-content">

                                            <div class="ltn__myaccount-tab-content-inner">
                                                <p>Lista zakupów</p>
                                                <div class="ltn__form-box">
                                                    <div class="ltn__myaccount-tab-content-inner">
                                                        <div class="table-responsive">

                                                            @foreach($shopping_list as $item)
                                                                <p class="text-center">
                                                                    <label>Shopping List ID:</label>
                                                                <h1 class="text-center">#{{$item->id}}</h1>
                                                                 </p>

                                                                @foreach ($item->orders as $index => $item)
                                                                    <p class="text-center">
                                                                        <label>Order ID:</label>
                                                                    <h1 class="text-center">#{{$item->id}}</h1>
                                                                    </p>
                                                                    <br>

                                                                <td>Address:</td>
                                                                <p><strong>{{$item->address->name}} {{{$item->address->surname}}}</strong></p>
                                                                <p>{{$item->address->city}}, {{$item->address->street}}<br>
                                                                    {{$item->address->zip_code}}, {{$item->address->voivodeship}}</p>
                                                                <p>Telefon: {{$item->address->phone_number}}</p>
                                                                @php break;@endphp
                                                                @endforeach
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
                                                                @foreach($shopping_list as $index => $item)
                                                                    @foreach ($item->shopping_lists_products as $index => $item)
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
                                                                <h4 class="pt-4 pb-2">Cykliczne dostawy:</h4>
                                                                <div id="refreshShoppingList">
                                                                <p>
                                                                    <label>Ustawiony dzień realizacji cyklicznych dostaw: </label>
                                                                    @foreach($shopping_list as $item)
                                                                        @foreach ($item->orders as $index => $itemm)
                                                                        {{ \Carbon\Carbon::parse($itemm->set_delivery_date)->locale('pl')->isoFormat('dddd') }}
                                                                    <br>




                                                                    <label>Najbliższa data cyklicznej dostawy: {{ date('Y-m-d', strtotime($itemm->set_delivery_date)) }}</label>

                                                                    @php break;@endphp
                                                                        @endforeach
                                                                    @endforeach

                                                                    <br>
                                                                 </div>
                                                                </p>

                                                                <h4><small><a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                            Zmień dzień dostaw
                                                                        </a></small></h4>

                                                                <div class="collapse" id="collapseExample">
                                                                    <div class="card card-body">
                                                                        <form class="selectDay" method="POST">
                                                                            @csrf

                                                                            <input type="hidden" name="order" value="{{ $item }}">


                                                                            <div class="col-md-6">
                                                                                <div class="input-item">
                                                                                    <label>Dzień cyklicznych dostaw:</label>
                                                                                    <select name="select" class="nice-select">
                                                                                        <option value="0"> Wybierz dzień</option>
                                                                                        @foreach($collectionDates as $date)
                                                                                            <option value={{$date['date']}}> {{$date['name']}} (dostawa:{{ $date['date'] }} )
                                                                                                @endforeach
                                                                                            </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                </p>

                                                                <h4 class="pt-4 pb-2">Status:</h4>
                                                                <br>

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
                                                                                @foreach($shopping_list as $item)
                                                                                    {{$item->total}}
                                                                                    @php break;@endphp
                                                                                @endforeach
                                                                            </strong></td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                                <button class="theme-btn-1 btn btn-effect-1 saveDay" data-id="{{$itemm->id}}" type="submit">
                                                                    {{ __('Save changes') }}
                                                                </button>





                                                        </div>

                                                        <div class="btn-wrapper">
                                                            <a href="{{ route('shoppingList.upload', $item->id) }}" class="theme-btn-2 btn btn-effect-2">{{ __('Załaduj listę zakupów do dalszej edycji') }}</a>
                                                        </div>

                                                        <br>
                                                        <button class="theme-btn-1 btn btn-effect-1">
                                                            {{ __('Załaduj listę zakupów do dalszej edycji') }}
                                                        </button>
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
    saveDayUrl: '{{url('/shopping_list/save_day')}}/',

    }
@endsection
