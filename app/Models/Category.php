<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function scopeFilter($query, array $filters){
        $query->when($filters["search"] ?? false, function($query, $search){
            return $query->where(function($query) use($search) {
                $query->where("category_name", "like", '%' . $search . '%');
            });
        });

        $query->when($filters["product"] ?? false, function($query, $product){
            return $query->whereHas("products", function($query) use($product){
                $query->where("product_name", $product);
            });
        });

    }

    public function products(){
        return $this->belongsToMany(Product::class, "product_categories");
    }
}
