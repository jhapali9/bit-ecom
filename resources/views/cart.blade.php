
@extends('layouts.master')

@section('content')

    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="container">



    <section class="cart container mt-2 my-3 py-5">
        <div class="container mt-2">
            <h4>Your Cart</h4>
            @foreach($errors->all() as $error)
                <h3>{{ $error }}</h3>
            @endforeach
        </div>


        <table class="pt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>


            @if(Session::has('cart'))
                @foreach(Session::get('cart') as $product)
                    <tr>
                        <td>
                            <div class="product-info">
                                <img src="{{ asset('img/'.$product['image']) }}">
                                <div>
                                    <p>{{ $product['name'] }}</p>
                                    <small><span>Rs</span>{{ $product['price'] }}</small>
                                    <br>
                                    <form action="{{ route('remove_from_cart') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product['id'] }}">
                                        <input type="submit" class="remove-btn" value="remove">
                                    </form>
                                </div>
                            </div>
                        </td>

                        <td>
                            <form>
                                <input type="number" name="quantity" value="1">
                                <input type="submit" value="edit" class="edit-btn" name="edit_product_quantity_btn">
                            </form>
                        </td>

                        <td>
                            <span class="product-price">Rs {{ $product['price'] }}</span>
                        </td>
                    </tr>
                @endforeach
            @endif

        </table>


        <div class="cart-total">
            <table>

                <tr>
                    <td>Total</td>
                    @if (Session::has('totalPrice'))
                        <td>RS {{ Session::get('totalPrice') }}</td>
                    @endif
                </tr>

            </table>
        </div>


        <div class="checkout-container">

            <form >
                <input type="submit" class="btn checkout-btn" value="Checkout" name="">
            </form>


        </div>





    </section>
        </div>
    </div>
    <!-- Cart End -->

@endsection
