<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable {
    use HasFactory, HasApiTokens, Notifiable;

    protected $guarded = ["id"];

    public function userDetail(){
        return $this->hasOne(UserDetail::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function cart(){
        return $this->belongsToMany(Product::class, "carts", "buyer_id");
    }

    public function wishlist(){
        return $this->belongsToMany(Product::class, "wishlists", "buyer_id");
    }
}
