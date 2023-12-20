<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your active shopping list have unavailable products in!</title>
</head>
<body>
<h2>You have shopping lists with unavailable products in</h2>



@foreach($shopping_lists as $index => $shopping_list)

    <h1>Title: {{$shopping_list->title}}</h1>
    {{$index +1}}



    <table style="width: 100%; border-collapse: collapse; margin: 0 auto;">
        <thead>
        <tr>
            <th style="border: 1px solid #ddd; padding: 8px;">#</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Product Image</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Product Name</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Price</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Quantity</th>
            <th style="border: 1px solid #ddd; padding: 8px;">Subtotal</th>
        </tr>
        </thead>
        <tbody>





        @foreach($shopping_list->shopping_lists_products as $index => $item)
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $index+1 }}.</td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                    <a href="product-details.html" style="display: inline-block; vertical-align: middle;">
                        <img src="{{ $message->embed(public_path('storage/' . $item->product->image->name)) }}" alt="Product Image" width="100" height="100" style="display: block; margin: 0 auto;">
                    </a>
                </td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">{{ $item->product->name }}</td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">${{ $item->product->price }}</td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">x{{ $item->quantity }}</td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">${{ $item->sub_total }}</td>
            </tr>
        @endforeach





        </tbody>
    </table>


@endforeach



<p>Thank you for choosing our store. If you have any questions, please contact us.</p>
</body>
</html>
