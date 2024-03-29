@extends('layouts.appwhite')

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
                            <h6 class="section-subtitle ltn__secondary-color">// Witaj w naszym sklepie</h6>
                            <h1 class="section-title white-color">Użytkownicy</h1>
                        </div>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="index.html">Start</a></li>
                                <li>Użytkownicy</li>
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
                        <th>Rola</th>
                        <th>Imie</th>
                        <th>Nazwisko</th>
                        <th>Email</th>
                        <th>Data utworzenia</th>
                        <th>Data aktualizacji</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>

                            <td class="cart-product-name">#{{$user->id}}</td>
                            <td class="cart-product-name">{{$user->role->name}}
                                @can('isAdmin')
                                    <a href="{{route('user.editRole', $user->id)}}" role="button" aria-expanded="false" aria-controls="collapseDayPicker">
                                        <button class="icon-edit"></button>
                                    </a>
                                    @endcan
                            </td>
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
