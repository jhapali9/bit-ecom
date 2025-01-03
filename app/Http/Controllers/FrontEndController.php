<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route as FacadesRoute;

class FrontEndController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('index', ['products' => $products]);
    }
    public function about()
    {
        return view('about');
    }
    public function products()
    {
        return view('products');
    }


    public function singleProduct($id)
    {
        $product = Product::find($id);
        return view('single_product',['product'=>$product]);
    }



    public function checkout()
    {
        return view('checkout');
    }


    public function cart(Request $request)
    {
        if($request->session()->has('cart')){
            $this->calculateTotal($request);
        }
        return view('cart');
    }

    public function add_to_cart(Request $request){
        // if session exist
        if($request->session()->has('cart')){

            $cart = $request->session()->get('cart');

            $product_ids = array_column($cart,'id');

            if(!in_array($request->id,$product_ids)){
                $id = $request->id;
                $name = $request->name;
                $image = $request->image;
                $quantity = $request->quantity;
                ($request->sale_price != null) ? $price = $request->sale_price : $price = $request->price;

                $product_array = array(
                    'id' => $id,
                    'name' => $name,
                    'image' => $image,
                    'quantity' => $quantity,
                    'price'=> $price
                );

                $cart[$request->id] = $product_array;

                $request->session()->put('cart',$cart);

                $this->calculateTotal($request);

                return view('cart');
            }else{
                return redirect()->back()->withErrors(['message'=>'Product already added to cart']);
            }




        // if session doesnot exist
        }else{
            $id = $request->id;
            $name = $request->name;
            $image = $request->image;
            $quantity = $request->quantity;
            ($request->sale_price != null) ? $price = $request->sale_price : $price = $request->price;

            $product_array = array(
                'id' => $id,
                'name' => $name,
                'image' => $image,
                'quantity' => $quantity,
                'price'=> $price
            );

            $cart[$request->id] = $product_array;

            $request->session()->put('cart',$cart);

            $this->calculateTotal($request);

            return view('cart');

        }

    }

    public function calculateTotal($request){
        $cart = $request->session()->get('cart');
        $totalPrice = 0;
        foreach($cart as $c){
            $totalPrice = $totalPrice + $c['quantity']*$c['price'];
        }
        $request->session()->put('totalPrice',$totalPrice);
    }

    public function remove_from_cart(Request $request){
        $cart = $request->session()->get('cart');
        $id_to_delete = $request->id;
        unset($cart[$id_to_delete]);
        $request->session()->put('cart',$cart);
        return redirect()->back()->withErrors(['message'=>'Cart item deleted successfully.']);
    }

    public function place_order(Request $request){
        // dd($request->all());

        $order = new Order();
        $order->name = $request->name;
        $order->email = $request->email;
        $order->city = $request->city;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->cost = $request->session()->get('totalPrice');
        $order->status = "not paid";
        $order->date = date("y-m-d");
        $order->save();

        $cart = $request->session()->get('cart');

        foreach($cart as $c){
            $orderitem = new OrderItem();
            $orderitem->order_id = $order->id;
            $orderitem->product_id = $c['id'];
            $orderitem->product_name = $c['name'];
            $orderitem->product_price = $c['price'];
            $orderitem->product_image = $c['image'];
            $orderitem->product_quantity = $c['quantity'];
            $orderitem->order_date = date("y-m-d");
            $orderitem->save();
        }

        // order id
        $request->session()->put('order_id',$order->id);
        
        return view('payment');

    }


}
