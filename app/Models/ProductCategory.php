<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
