<?php

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\UserDetail;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WishlistController;
use Illuminate\Database\Eloquent\Collection;

Route::get("/", function(){
    return redirect("/products");
});

Route::get("/about", function(){
    return view("mainpage.about");
});

Route::get("/products", function(){
    return view("mainpage.allproducts", [
        "products" => Product::filter(request(["search", "category"]))->get()
    ]);
});

Route::get("/categories", function(){
    return view("mainpage.allcategories", [
        "categories" => Category::all(),
        "products" => Product::all()
    ]);
});

Route::get("/categories/{category:slug}", function(Category $category){
    return view("mainpage.productsbycategory", [
        "category" => $category,
        "title" => $category->category_name . " Products"
    ]);
});

Route::get("/login", [LoginController::class, "index"])->name("login")->middleware("guest");
Route::post("/login", [LoginController::class, "authenticate"]);
Route::post("/logout", [LoginController::class, "logout"]);

Route::get("/register", [RegisterController::class, "index"])->middleware("guest");
Route::post("/register", [RegisterController::class, "store"]);

Route::resource("/cart", CartController::class)->middleware("auth");
Route::resource("/wishlist", WishlistController::class)->middleware("auth");

Route::get("/productdetails/{product:slug}", function(Product $product){
    return view("mainpage.productdetails", [
        "product" => $product,
        "otherproducts" => Product::where("seller_id", $product->seller->id)->get()
    ]);
});

Route::resource("/manage-products", ProductController::class);

Route::resource("/profile", ProfileController::class);
