<html>
<head>
    <meta charset="utf8">
    <title>Product</title>
</head>
<body>

<p>Здраво пријател,</p>


<p>Корисникот {{ $product->user->name }} додаде нов продукт во вашиот систем со име {{ $product->name }}
    пред {{ $product->created_at->diffForHumans() }}. </p>


</body>
</html>
