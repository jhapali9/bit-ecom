<!DOCTYPE html>
<html lang="en">
<head>
    <title>Payment Page</title>
</head>
<body>
    <h1>Order Id: {{ Session::get('order_id') }}</h1>
    <h1>Total Price: {{ Session::get('totalPrice') }}</h1>
    <h1><a href="/processPayment">Pay Now</a></h1>
</body>
</html>
