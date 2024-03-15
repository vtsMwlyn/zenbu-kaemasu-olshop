<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        return view("buyer.cart", [
            "products" => Product::all()
        ]);
    }

    public function store(Request $request){
        $product = Product::where("slug", $request->prodslug)->get()[0];

        if($product->seller->id == auth()->user()->id){
            return redirect(route("cart.index"))->with("failAddCartSelf", "You can't add your own product in your cart");
        }

        $existing = Cart::where("buyer_id", auth()->user()->id)->where("product_id", $product->id)->exists();

        if($existing){
            return redirect(route("cart.index"))->with("failAddCartExist", "This item has been already in your cart");
        }

        Cart::create(["buyer_id" => auth()->user()->id, "product_id" => $product->id]);

        return redirect(route("cart.index"))->with("successAddCart", "\"" . $product->product_name . "\"" . " has been added to your cart");
    }

    public function destroy($prodslug){
        $product = Product::where("slug", $prodslug)->first();
        $cart = Cart::where("product_id", $product->id)->where("buyer_id", auth()->user()->id)->first();

        Cart::destroy("id", $cart->id);

        if(Cart::where("id", $cart->id)->exists()){
            return redirect(route("cart.index"))->with("unsuccessRemoveCart", "\"" . "Error occured, please try again.");
        }
        else {
            return redirect(route("cart.index"))->with("successRemoveCart", "\"" . $product->product_name . "\"" . " has been removed from your cart");
        }

    }
}
