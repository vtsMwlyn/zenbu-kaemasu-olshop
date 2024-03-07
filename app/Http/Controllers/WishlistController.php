<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(){
        return view("buyer.wishlist", [
            "products" => Product::all()
        ]);
    }

    public function store(Request $request){
        $product = Product::where("slug", $request->prodslug)->get()[0];

        if($product->seller->id == auth()->user()->id){
            return redirect("/wishlist")->with("failAddWishlistSelf", "You can't add your own product in your wishlist");
        }

        $existing = Wishlist::where("buyer_id", auth()->user()->id)->where("product_id", $product->id)->exists();

        if($existing){
            return redirect("/wishlist")->with("failAddWishlistExist", "This item has been already in your wishlist");
        }

        Wishlist::create(["buyer_id" => auth()->user()->id, "product_id" => $product->id]);

        return redirect("/wishlist")->with("successAddWishlist", "\"" . $product->product_name . "\"" . " has been added to your wishlist");
    }

    public function destroy($prodslug){
        $product = Product::where("slug", $prodslug)->get()[0];
        $wishlist = Wishlist::where("product_id", $product->id)->get()[0];

        Wishlist::destroy("id", $wishlist->id);

        if(Wishlist::where("id", $wishlist->id)->exists()){
            return redirect("/wishlist")->with("unsuccessRemoveWishlist", "\"" . "Error occured, please try again.");
        }
        else {
            return redirect("/wishlist")->with("successRemoveWishlist", "\"" . $product->product_name . "\"" . " has been removed from your wishlist");
        }
    }
}
