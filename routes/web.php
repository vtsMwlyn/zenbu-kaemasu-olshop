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
    return redirect(route("products"));
})->name("home");

Route::get("/about", function(){
    return view("mainpage.about");
})->name("about");

Route::get("/products", function(){
    return view("mainpage.allproducts", [
        "categories" => Category::all(),
        "products" => Product::filter(request(["search", "category"]))->get()
    ]);
})->name("products");

Route::get("/categories", function(){
    return view("mainpage.allcategories", [
        "categories" => Category::filter(request(["search"]))->get(),
        "products" => Product::all()
    ]);
})->name("categories");

Route::get("/categories/{category:slug}", function(Category $category){
    return view("mainpage.productsbycategory", [
        "currCategory" => $category,
        "title" => $category->category_name . " Products"
    ]);
})->name("productbycategory");

Route::get("/login", [LoginController::class, "index"])->name("login")->middleware("guest");
Route::post("/login", [LoginController::class, "authenticate"])->name("login.store");
Route::post("/logout", [LoginController::class, "logout"])->name("logout");

Route::get("/register", [RegisterController::class, "index"])->middleware("guest")->name("register");
Route::post("/register", [RegisterController::class, "store"])->name("register.store");

Route::resource("/cart", CartController::class, ["names" => ["index" => "cart.index", "store" => "cart.store", "destroy" => "cart.destroy"]])->middleware("auth");
Route::resource("/wishlist", WishlistController::class, ["names" => ["index" => "wishlist.index", "store" => "wishlist.store", "destroy" => "wishlist.destroy"]])->middleware("auth");

Route::get("/productdetails/{product:slug}", function(Product $product){
    return view("mainpage.productdetails", [
        "product" => $product,
        "otherproducts" => Product::where("seller_id", $product->seller->id)->get()
    ]);
})->name("productdetails");

Route::resource("/manage-products", ProductController::class, ["names" => ["index" => "manageproduct.index", "store" => "manageproduct.store", "create" => "manageproduct.create", "edit" => "manageproduct.edit", "update" => "manageproduct.update", "destroy" => "manageproduct.destroy"]]);

Route::get("/profile", [ProfileController::class, "index"])->name("profile");
Route::post("/profile", [ProfileController::class, "update"])->name("profile.update");
