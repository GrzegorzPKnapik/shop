<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping list activated</title>
</head>
<body>
<h2>Shopping list activated</h2>

<p>Your shopping list #{{$shopping_list->id}} has been activated!</p>


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



<!-- Tabela z "Total" -->
<table style="width: 15%; margin: 20px 0; float: right; text-align: center;">
    <tbody>
    <tr>
        <td colspan="2" style="border: 1px solid #ddd; padding: 8px;">Total: ${{ $shopping_list->total }}</td>
    </tr>
    </tbody>
</table>



<p>Thank you for choosing our store. If you have any questions, please contact us.</p>
</body>
</html>
