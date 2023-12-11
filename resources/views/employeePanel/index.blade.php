@extends('layouts.appwhite')

@section('content')

    <body>


    <!-- Add your site or application content here -->

    <!-- Body main wrapper start -->
    <div class="body-wrapper">
        @include('helpers.responses')


        <!-- BREADCRUMB AREA START -->
        <div
            class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image"
            data-bg="img/bg/9.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                            <div class="section-title-area ltn__section-title-2">
                                <h6 class="section-subtitle ltn__secondary-color">// Welcome to our company</h6>
                                <h1 class="section-title white-color">My Account</h1>
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
        <!-- BREADCRUMB AREA END -->

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
                                                <a class="active show" data-bs-toggle="tab" href="#liton_tab_1_1">Dashboard
                                                    <i class="fas fa-home"></i></a>
                                                <a href="{{ url(route('users.index')) }}">Users <i class="fas fa-file-alt"></i></a>
                                                <a href="{{ url(route('order.index')) }}">Orders <i class="fas fa-file-alt"></i></a>
                                                <a href="{{ url(route('shopping_list.index')) }}">Shopping lists <i class="fas fa-file-alt"></i></a>
                                                <a href="{{ url(route('product.index')) }}">Products <i class="fas fa-file-alt"></i></a>
                                                <a href="{{ url(route('categorie.index')) }}">Categories <i class="fas fa-file-alt"></i></a>
                                                <a href="{{ url(route('producer.index')) }}">Categories <i class="fas fa-file-alt"></i></a>


                                                <a href="login.html">Logout <i class="fas fa-sign-out-alt"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="liton_tab_1_1">
                                                <div class="ltn__myaccount-tab-content-inner">
                                                    <p>Hello <strong>
                                                                {{ Auth::user()->name }}
                                                            </strong> (not <strong>UserName</strong>?
                                                        <small><a href="login-register.html">Log out</a></small> )</p>
                                                    <p>From your account dashboard you can view your
                                                        <span>recent orders</span>, manage your <span>shipping and billing addresses</span>,
                                                        and <span>edit your password and account details</span>.</p>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="liton_tab_1_7">
                                                <div class="ltn__myaccount-tab-content-inner">
                                                    <p>Aktywne cykliczne dostawy(cykliczna lista zakupów).</p>
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
                                                                        @if($order->status != 'delivered')
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

                                            <div class="tab-pane fade" id="liton_tab_1_8">
                                                <div class="ltn__myaccount-tab-content-inner">
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
                                                                        {{$product->price}}
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

                                            <div class="tab-pane fade" id="liton_tab_1_9">
                                                <div class="ltn__myaccount-tab-content-inner">
                                                    <div class="table-responsive">
                                                        <div class="mb-4">
                                                            <a href="{{ route('category.create') }}" class="theme-btn-1 btn btn-effect-1">{{ __('Dodaj nową kategorie') }}</a>
                                                        </div>
                                                        <table class="table text-center table-sm">
                                                            <thead>
                                                            <tr>
                                                                <th>Id</th>
                                                                <th>Name</th>
                                                                <th>Create date</th>
                                                                <th>Update date</th>
                                                                <th>Action</th>


                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($categories as $category)
                                                                <tr class="align-middle delete_mem{{$category->id}}">
                                                                    <td class="cart-product-info">
                                                                        <h4><a>#{{$category->id}}</a></h4>
                                                                    </td>

                                                                    <td class="cart-product-info">
                                                                        {{$category->name}}
                                                                    </td>

                                                                    <td class="cart-product-info">
                                                                        {{$category->created_at}}
                                                                    </td>
                                                                    <td class="cart-product-info">
                                                                        {{$category->updated_at}}
                                                                    </td>
                                                                    <td>
                                                                        <button class="icon-cancel deleteCategory" data-id="{{$category->id}}"></button>

                                                                        <a href="{{ route('category.edit', $category->id) }}">
                                                                            <button class="icon-edit"></button>
                                                                        </a>

                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="tab-pane fade" id="liton_tab_1_10">
                                                <div class="ltn__myaccount-tab-content-inner">
                                                    <div class="table-responsive">
                                                        <div class="mb-4">
                                                            <a href="{{ route('producer.create') }}" class="theme-btn-1 btn btn-effect-1">{{ __('Dodaj nowego producenta') }}</a>
                                                        </div>
                                                        <table class="table text-center table-sm">
                                                            <thead>
                                                            <tr>
                                                                <th>Id</th>
                                                                <th>Name</th>
                                                                <th>Create date</th>
                                                                <th>Update date</th>
                                                                <th>Action</th>


                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($producers as $producer)
                                                                <tr class="align-middle delete_mem{{$producer->id}}">
                                                                    <td class="cart-product-info">
                                                                        <h4><a>#{{$producer->id}}</a></h4>
                                                                    </td>

                                                                    <td class="cart-product-info">
                                                                        {{$producer->name}}
                                                                    </td>

                                                                    <td class="cart-product-info">
                                                                        {{$producer->created_at}}
                                                                    </td>
                                                                    <td class="cart-product-info">
                                                                        {{$producer->updated_at}}
                                                                    </td>
                                                                    <td>
                                                                        <button class="icon-cancel deleteProducer" data-id="{{$producer->id}}"></button>

                                                                        <a href="{{ route('producer.edit', $producer->id) }}">
                                                                            <button class="icon-edit"></button>
                                                                        </a>

                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="liton_tab_1_2">
                                                <div class="ltn__myaccount-tab-content-inner">
                                                    <div class="table-responsive">
                                                        <table class="table text-center table-sm">
                                                            <thead>
                                                            <tr>
                                                                <th>Number</th>
                                                                <th>User number</th>
                                                                <th>Date</th>
                                                                <th>Price</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($orders as $item)
                                                                <tr>

                                                                    <td class="cart-product-name">#{{$item->id}}</td>
                                                                    <td class="cart-product-name">#{{$item->shopping_list->user->id}}</td>
                                                                    <td class="cart-product-name">{{$item->created_at}}</td>
                                                                    <td class="cart-product-name">${{$item->shopping_list->total}}</td>
                                                                    <td>
                                                                        <a href="{{ route('order.show', $item->id) }}">
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
                                            <div class="tab-pane fade" id="liton_tab_1_3">
                                                <div class="ltn__myaccount-tab-content-inner">
                                                    <div class="table-responsive">
                                                        <table class="table text-center table-sm">
                                                            <thead>
                                                            <tr>
                                                                <th>Number</th>
                                                                <th>Name</th>
                                                                <th>Surname</th>
                                                                <th>Email</th>
                                                                <th>Create date</th>
                                                                <th>Update date</th>

                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($users as $user)
                                                                <tr>

                                                                    <td class="cart-product-name">#{{$user->id}}</td>
                                                                    <td class="cart-product-name">{{$user->name}}</td>
                                                                    <td class="cart-product-name">{{$user->surname}}</td>
                                                                    <td class="cart-product-name">{{$user->email}}</td>
                                                                    <td class="cart-product-name">{{$user->created_at}}</td>
                                                                    <td class="cart-product-name">{{$user->updated_at}}</td>

                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="liton_tab_1_6">
                                                <div class="ltn__myaccount-tab-content-inner">
                                                    <p>The following addresses will be used on the checkout page by
                                                        default.</p>
                                                    <div class="ltn__form-box">



                                                        <form class="addAddress" id="address" method="POST">
                                                            <div id="refreshForm">
                                                            @csrf
                                                            <div class="row mb-50">
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label>Imie:</label>
                                                                        <input id="name" type="text" placeholder="Imie"
                                                                               class="form-control @error('name') is-invalid @enderror"
                                                                               name="name"
                                                                               required autocomplete="name" autofocus>
                                                                        @error('name')
                                                                        <span class="invalid-feedback" role="alert">
                                                                          <strong>{{$message }}</strong>
                                                                             </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label>Nazwisko:</label>
                                                                        <input id="surname" type="text" placeholder="Nazwisko"
                                                                               class="form-control @error('surname') is-invalid @enderror"
                                                                               name="surname"
                                                                               required autocomplete="surname" autofocus>
                                                                        @error('surname')
                                                                        <span class="invalid-feedback" role="alert">
                                                                          <strong>{{$message }}</strong>
                                                                             </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label>Miasto:</label>
                                                                        <input id="city" type="text" placeholder="Miasto"
                                                                               class="form-control @error('city') is-invalid @enderror"
                                                                               name="city" value="{{ old('city') }}"
                                                                               required autocomplete="city" autofocus>
                                                                        @error('city')
                                                                        <span class="invalid-feedback" role="alert">
                                                                          <strong>{{$message }}</strong>
                                                                             </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">

                                                                    <div class="mb-3">
                                                                        <label>Ulica:</label>
                                                                        <input id="street" type="text" placeholder="Ulica"
                                                                               class="form-control @error('street') is-invalid @enderror"
                                                                               name="street" value="{{ old('street') }}"
                                                                               required autocomplete="street" autofocus>
                                                                        @error('street')
                                                                        <span class="invalid-feedback" role="alert">
                                                                          <strong>{{$message }}</strong>
                                                                             </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">

                                                                    <div class="mb-3">
                                                                        <label>Kod pocztowy:</label>
                                                                        <input id="zip_code" type="text" placeholder="Kod pocztowy"
                                                                               class="form-control @error('zip_code') is-invalid @enderror"
                                                                               name="zip_code" value="{{ old('zip_code') }}"
                                                                               required autocomplete="zip_code" autofocus>
                                                                        @error('zip_code')
                                                                        <span class="invalid-feedback" role="alert">
                                                                          <strong>{{$message }}</strong>
                                                                             </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">

                                                                    <div class="mb-3">
                                                                        <label>Województwo:</label>
                                                                        <input id="voivodeship" type="text" placeholder="Województwo"
                                                                               class="form-control @error('voivodeship') is-invalid @enderror"
                                                                               name="voivodeship" value="{{ old('voivodeship') }}"
                                                                               required autocomplete="voivodeship" autofocus>
                                                                        @error('voivodeship')
                                                                        <span class="invalid-feedback" role="alert">
                                                                          <strong>{{$message }}</strong>
                                                                             </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">

                                                                    <div class="mb-3">
                                                                        <label>Numer telefonu:</label>
                                                                        <input id="phone_number" type="text" placeholder="Numer telefonu"
                                                                               class="form-control @error('phone_number') is-invalid @enderror"
                                                                               name="phone_number" value="{{ old('phone_number') }}"
                                                                               required autocomplete="phone_number" autofocus>
                                                                        @error('phone_number')
                                                                        <span class="invalid-feedback" role="alert">
                                                                          <strong>{{$message }}</strong>
                                                                             </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="btn-wrapper">
                                                                <button type="submit"
                                                                        class="btn theme-btn-1 btn-effect-1 text-uppercase save-address">
                                                                    {{__('Save changes')}}
                                                                </button>
                                                            </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="liton_tab_1_5">
                                                <div class="ltn__myaccount-tab-content-inner">
                                                    <p>The following addresses will be used on the checkout page by
                                                        default.</p>
                                                    <div class="ltn__form-box">
                                                        <form action="#">
                                                            <div class="row mb-50">
                                                                <div class="col-md-6">

                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label>Display Name:</label>
                                                                    <input type="text" name="ltn__lastname"
                                                                           placeholder="Ethan">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label>Display Email:</label>
                                                                    <input type="email" name="ltn__lastname"
                                                                           placeholder="example@example.com">
                                                                </div>
                                                            </div>
                                                            <fieldset>
                                                                <legend>Password change</legend>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <label>Current password (leave blank to leave
                                                                            unchanged):</label>
                                                                        <input type="password" name="ltn__name">
                                                                        <label>New password (leave blank to leave
                                                                            unchanged):</label>
                                                                        <input type="password" name="ltn__lastname">
                                                                        <label>Confirm new password:</label>
                                                                        <input type="password" name="ltn__lastname">
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                            <div class="btn-wrapper">
                                                                <button type="submit"
                                                                        class="btn theme-btn-1 btn-effect-1 text-uppercase">
                                                                    Save Changes
                                                                </button>
                                                            </div>
                                                        </form>
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
        <!-- WISHLIST AREA START -->

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

        <!-- FOOTER AREA START -->
        <footer class="ltn__footer-area  ">
            <div class="footer-top-area  section-bg-1 plr--5">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 col-sm-6 col-12">
                            <div class="footer-widget footer-about-widget">
                                <div class="footer-logo">
                                    <div class="site-logo">
                                        <img src="img/logo.png" alt="Logo">
                                    </div>
                                </div>
                                <p>Lorem Ipsum is simply dummy text of the and typesetting industry. Lorem Ipsum is
                                    dummy text of the printing.</p>
                                <div class="footer-address">
                                    <ul>
                                        <li>
                                            <div class="footer-address-icon">
                                                <i class="icon-placeholder"></i>
                                            </div>
                                            <div class="footer-address-info">
                                                <p>Brooklyn, New York, United States</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="footer-address-icon">
                                                <i class="icon-call"></i>
                                            </div>
                                            <div class="footer-address-info">
                                                <p><a href="tel:+0123-456789">+0123-456789</a></p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="footer-address-icon">
                                                <i class="icon-mail"></i>
                                            </div>
                                            <div class="footer-address-info">
                                                <p><a href="mailto:example@example.com">example@example.com</a></p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="ltn__social-media mt-20">
                                    <ul>
                                        <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                                        <li><a href="#" title="Youtube"><i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                            <div class="footer-widget footer-menu-widget clearfix">
                                <h4 class="footer-title">Company</h4>
                                <div class="footer-menu">
                                    <ul>
                                        <li><a href="about.html">About</a></li>
                                        <li><a href="blog.html">Blog</a></li>
                                        <li><a href="shop.html">All Products</a></li>
                                        <li><a href="locations.html">Locations Map</a></li>
                                        <li><a href="faq.html">FAQ</a></li>
                                        <li><a href="contact.html">Contact us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                            <div class="footer-widget footer-menu-widget clearfix">
                                <h4 class="footer-title">Services.</h4>
                                <div class="footer-menu">
                                    <ul>
                                        <li><a href="order-tracking.html">Order tracking</a></li>
                                        <li><a href="wishlist.html">Wish List</a></li>
                                        <li><a href="login.html">Login</a></li>
                                        <li><a href="account.html">My account</a></li>
                                        <li><a href="about.html">Terms & Conditions</a></li>
                                        <li><a href="about.html">Promotional Offers</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                            <div class="footer-widget footer-menu-widget clearfix">
                                <h4 class="footer-title">Customer Care</h4>
                                <div class="footer-menu">
                                    <ul>
                                        <li><a href="login.html">Login</a></li>
                                        <li><a href="account.html">My account</a></li>
                                        <li><a href="wishlist.html">Wish List</a></li>
                                        <li><a href="order-tracking.html">Order tracking</a></li>
                                        <li><a href="faq.html">FAQ</a></li>
                                        <li><a href="contact.html">Contact us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-sm-12 col-12">
                            <div class="footer-widget footer-newsletter-widget">
                                <h4 class="footer-title">Newsletter</h4>
                                <p>Subscribe to our weekly Newsletter and receive updates via email.</p>
                                <div class="footer-newsletter">
                                    <form action="#">
                                        <input type="email" name="email" placeholder="Email*">
                                        <div class="btn-wrapper">
                                            <button class="theme-btn-1 btn" type="submit"><i
                                                    class="fas fa-location-arrow"></i></button>
                                        </div>
                                    </form>
                                </div>
                                <h5 class="mt-30">We Accept</h5>
                                <img src="img/icons/payment-4.png" alt="Payment Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ltn__copyright-area ltn__copyright-2 section-bg-2  ltn__border-top-2--- plr--5">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="ltn__copyright-design clearfix">
                                <p>All Rights Reserved @ Company <span class="current-year"></span></p>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 align-self-center">
                            <div class="ltn__copyright-menu text-right text-end">
                                <ul>
                                    <li><a href="#">Terms & Conditions</a></li>
                                    <li><a href="#">Claim</a></li>
                                    <li><a href="#">Privacy & Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- FOOTER AREA END -->
    </div>
    <!-- Body main wrapper end -->

    <!-- Javascript Requirements -->
    <!-- Laravel Javascript Validation -->

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\StoreAddressRequest') !!}
    </body>



@endsection

@section('javascript')
    const DATA = {
    editfieldUrl: '{{url('cart')}}/',
    selectAddressUrl: '{{url('address/select')}}/',
    storeAddressUrl: '{{url('address/store')}}',
    deleteAddressUrl: '{{url('address')}}/',
    }
@endsection
