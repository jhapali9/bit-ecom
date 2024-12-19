<?php

namespace App\Http\Controllers;

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
    public function cart()
    {
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

            return view('cart');

        }

    }
    
}