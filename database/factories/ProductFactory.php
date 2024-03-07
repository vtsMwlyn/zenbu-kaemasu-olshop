<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use function PHPSTORM_META\map;

class ProductFactory extends Factory{
    public function definition(){
        return [
            "seller_id" => mt_rand(1, 2),
            "product_name" => ucwords($this->faker->words(mt_rand(2, 4), true)),
            "slug" => $this->faker->slug(),
            "desc" => $this->faker->paragraph(mt_rand(5, 10)),
            "stock" => mt_rand(5, 100),
            "price" => mt_rand(5000, 200000)
        ];
    }
}
