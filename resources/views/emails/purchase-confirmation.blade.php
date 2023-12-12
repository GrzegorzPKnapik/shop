<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Purchase confirmation#</title>
</head>
<body>

The order was successfully placed.

Order details

<p class="text-center">
    <label>Order ID:</label>
<h1 class="text-center">#{{$data->id}}</h1>
</p>


<br>
dddddddddddddddddddd
Address:<br>
<p><strong>{{$data->shopping_list->address->name}} {{$data->shopping_list->address->surname}}</strong></p>
<p>{{$data->shopping_list->address->city}}, {{$data->shopping_list->address->street}}<br>
    {{$data->shopping_list->address->zip_code}}, {{$data->shopping_list->address->zip_code}}</p>
<p>Telefon: {{$data->shopping_list->address->phone_number}}</p>

Items:
@foreach($data->shopping_list->shopping_lists_products as $index => $item)
    <tr>
        <td class="cart-product-name">{{ $index+1}}.</td>
        <td class="cart-product-image"> <a href="product-details.html"><img src="{{asset('storage/' . $item->product->image->name)}}" alt="Zdjęcie"></a></td>
        <td class="cart-product-image">
            <a href="product-details.html">
                <img src="{{ $message->embed(public_path('storage/' . $item->product->image->name)) }}" alt="Zdjęcie">
            </a>
        </td>
        <td class="cart-product-name">{{$item->product->name}}</td>
        <td class="cart-product-name">${{$item->product->price}}</td>
        <td class="cart-product-name">x{{$item->quantity}}</td>
        <td class="cart-product-subtotal">${{$item->sub_total}}</td>
    </tr>
@endforeach



</body>
</html>
