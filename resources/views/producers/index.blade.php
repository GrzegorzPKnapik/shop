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
                            <h1 class="section-title white-color">Producenci</h1>
                        </div>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="index.html">Start</a></li>
                                <li>Producenci</li>
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
                    <a href="{{ route('producer.create') }}" class="theme-btn-1 btn btn-effect-1">{{ __('Dodaj nowego producenta') }}</a>
                </div>
                <table class="table text-center table-sm">
                    <thead>
                    <tr>
                        <th>Numer</th>
                        <th>Nazwa</th>
                        <th>Data utworzenia</th>
                        <th>Data aktualizacji</th>
                        <th>Akcje</th>


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
    <!-- LOGIN AREA END -->

<div class="mb-50">

</div>
    <div class="ltn__utilize-overlay"></div>

</div>
@endsection


@section('js-files')
@endsection
