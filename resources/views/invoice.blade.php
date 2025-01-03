<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>
    @php
        $order_id = Session::get('order_id');
        $totalAmount = Session::get('totalPrice');
    @endphp
    <h1>Order Id: {{ $order_id }}</h1>

</body>
</html>
