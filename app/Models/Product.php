<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model{
    use HasFactory;

    protected $guarded = ["id"];

    public function scopeFilter($query, array $filters){
        $query->when($filters["search"] ?? false, function($query, $search){
            return $query->where(function($query) use($search) {
                $query->where("product_name", "like", '%' . $search . '%');
            });
        });

        $query->when($filters["category"] ?? false, function($query, $category){
            return $query->whereHas("categories", function($query) use($category){
                $query->where("slug", $category);
            });
        });
    }

    public function seller(){
        return $this->belongsTo(User::class);
    }

    public function carts(){
        return $this->belongsToMany(Cart::class, "carts");
    }

    public function wishlists(){
        return $this->belongsToMany(Wishlist::class, "wishlists");
    }

    public function categories(){
        return $this->belongsToMany(Category::class, "product_categories");
    }
}
