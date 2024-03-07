<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Role;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\UserDetail;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder{
    public function run(){
        //Generate users and roles
        Role::create(["role_name" => "Buyer"]);
        Role::create(["role_name" => "Seller"]);

        User::create(["role_id" => 2, "email" => "kirifujinagisa@email.com", "password" => bcrypt("kirifujinagisa")]);
        User::create(["role_id" => 2, "email" => "misonomika@email.com", "password" => bcrypt("misonomika")]);
        User::create(["role_id" => 1, "email" => "yurizonoseia@email.com", "password" => bcrypt("yurizonoseia")]);

        UserDetail::create(["user_id" => 1, "username" => "kirifujinagisa", "real_name" => "Kirifuji Nagisa", "phone" => "08xxxxxxxxxx", "dob" => "2000-01-01", "address" => "Somewhere on Blue Archive universe"]);
        UserDetail::create(["user_id" => 2, "username" => "misonomika", "real_name" => "Misono Mika", "phone" => "08xxxxxxxxxx", "dob" => "2000-01-01", "address" => "Somewhere on Blue Archive universe"]);
        UserDetail::create(["user_id" => 3, "username" => "yurizonoseia", "real_name" => "Yurizono Seia", "phone" => "08xxxxxxxxxx", "dob" => "2000-01-01", "address" => "Somewhere on Blue Archive universe"]);

        //Generate products and categories
        $numberOfItemsToGenerate = 40;

        Category::create(["category_name" => "Fashion", "slug" => "fashion"]);
        Category::create(["category_name" => "Electronics", "slug" => "electronics"]);
        Category::create(["category_name" => "Tools", "slug" => "tools"]);
        Category::create(["category_name" => "Healthcares", "slug" => "healthcares"]);
        Category::create(["category_name" => "Food and beverages", "slug" => "food-and-beverages"]);

        Product::factory($numberOfItemsToGenerate)->create();

        for($i = 1; $i <= $numberOfItemsToGenerate; $i++){
            ProductCategory::create(["product_id" => $i, "category_id" => mt_rand(1, 5)]);
        }

        //Generate wishlists and carts
        Wishlist::create(["buyer_id" => 1, "product_id" => 5]);
        Wishlist::create(["buyer_id" => 1, "product_id" => 10]);
        Wishlist::create(["buyer_id" => 1, "product_id" => 15]);
        Wishlist::create(["buyer_id" => 2, "product_id" => 2]);
        Wishlist::create(["buyer_id" => 2, "product_id" => 9]);
        Wishlist::create(["buyer_id" => 2, "product_id" => 16]);
        Wishlist::create(["buyer_id" => 3, "product_id" => 4]);
        Wishlist::create(["buyer_id" => 3, "product_id" => 10]);
        Wishlist::create(["buyer_id" => 3, "product_id" => 16]);

        Cart::create(["buyer_id" => 1, "product_id" => 1]);
        Cart::create(["buyer_id" => 1, "product_id" => 2]);
        Cart::create(["buyer_id" => 2, "product_id" => 3]);
        Cart::create(["buyer_id" => 2, "product_id" => 4]);
        Cart::create(["buyer_id" => 3, "product_id" => 5]);
        Cart::create(["buyer_id" => 3, "product_id" => 6]);
    }
}
