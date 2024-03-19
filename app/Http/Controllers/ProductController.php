<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Database\Factories\ProductFactory;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller{
    public function index(){
        $this->authorize("seller");

        return view("seller.myproducts", [
            "products" => Product::where("seller_id", auth()->user()->id)->get()
        ]);
    }

    public function create(){
        $this->authorize("seller");

        return view("seller.addnewproduct", [
            "categories" => Category::all()
        ]);
    }

    public function store(Request $request){
        $this->authorize("seller");

        $validatedData = $request->validate([
            "productname" => "required",
            "price" => "required|numeric|gt:0",
            "stock" => "required|numeric|gt:0",
            "image" => "required|file|image|max:4096",
            "description" => "required",
            "slug" => "required",
            "checkbox" => "required"
        ]);

        if($request->file("image")){
            $validatedData["image"] = $request->file("image")->store("post-images");
        }

        $validatedData["seller_id"] = auth()->user()->id;

        $existing = Product::where("slug", $validatedData["slug"])->exists();
        if($existing){
            $validatedData["slug"] = $validatedData["slug"] . "-" . round(microtime(true) * 1000);
        }

        $newProductData = [
            "product_name" => $validatedData["productname"],
            "price" => $validatedData["price"],
            "stock" => $validatedData["stock"],
            "seller_id" => $validatedData["seller_id"],
            "desc" => $validatedData["description"],
            "prodimg_path" => $validatedData["image"],
            "slug" => $validatedData["slug"]
        ];

        $createdProductData = Product::create($newProductData);

        for($i = 0; $i < sizeof($validatedData["checkbox"]); $i++){
            $newProductCategoryData = [
                "product_id" => $createdProductData->id,
                "category_id" => $validatedData["checkbox"][$i]
            ];

            ProductCategory::create($newProductCategoryData);
        }

        return redirect(route("manageproduct.index"))->with("successAddProduct", "Successfully added a new product!");
    }

    public function show(Product $product){

    }

    public function edit($slug){
        $this->authorize("seller");

        $product = Product::where("slug", $slug)->first();
        if($product->seller_id != auth()->user()->id){
            abort(403);
        }

        $categories = Category::all();
        $furaggu = [];

        foreach($categories as $allctg){
            array_push($furaggu, 0);
        }

        for($i = 0; $i < sizeof($categories); $i++){
            for($j = 0; $j < sizeof($product->categories); $j++){
                if($categories[$i]->id == $product->categories[$j]->id){
                    $furaggu[$i] = 1;
                }
            }
        }

        return view("seller.editproduct", [
            "product" => $product,
            "categories" => $categories,
            "flags" => $furaggu
        ]);
    }

    public function update(Request $request, $slug){
        $this->authorize("seller");

        $product = Product::where("slug", $slug)->get()[0];
        if($product->seller_id != auth()->user()->id){
            abort(403);
        }

        $validatedUpdateData = $request->validate([
            "productname" => "required",
            "price" => "required|numeric|gt:0",
            "stock" => "required|numeric|gt:0",
            "image" => "file|image|max:4096",
            "description" => "required",
            "slug" => "required",
            "checkbox" => "required"
        ]);

        if($request->file("image")){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedUpdateData["image"] = $request->file("image")->store("post-images");
        }
        else {
            $validatedUpdateData["image"] = $product->prodimg_path;
        }

        $validatedUpdateData["seller_id"] = auth()->user()->id;

        if(Product::where("slug", $validatedUpdateData["slug"])->exists() && $validatedUpdateData["productname"] != $product->product_name){
            $validatedUpdateData["slug"] = $validatedUpdateData["slug"] . "-" . round(microtime(true) * 1000);
        }

        $newProductData = [
            "product_name" => $validatedUpdateData["productname"],
            "price" => $validatedUpdateData["price"],
            "stock" => $validatedUpdateData["stock"],
            "seller_id" => $validatedUpdateData["seller_id"],
            "desc" => $validatedUpdateData["description"],
            "slug" => $validatedUpdateData["slug"],
            "prodimg_path" => $validatedUpdateData["image"]
        ];

        Product::where("id", $product->id)->update($newProductData);

        $pctg = ProductCategory::where("product_id", $product->id)->get();
        foreach($pctg as $pc){
            ProductCategory::destroy($pc->id);
        }

        for($i = 0; $i < sizeof($validatedUpdateData["checkbox"]); $i++){
            $newProductCategoryData = [
                "product_id" => $product->id,
                "category_id" => $validatedUpdateData["checkbox"][$i]
            ];

            ProductCategory::create($newProductCategoryData);
        }

        return redirect(route("manageproduct.index"))->with("successUpdateProduct", "Product successfully updated!");
    }

    public function destroy($slug){
        $this->authorize("seller");

        $product = Product::where("slug", $slug)->get()[0];
        if($product->seller_id != auth()->user()->id){
            abort(403);
        }

        if($product->prodimg_path){
            Storage::delete($product->prodimg_path);
        }

        $pctg = ProductCategory::where("product_id", $product->id)->get()[0];
        ProductCategory::destroy($pctg->id);
        Product::destroy($product->id);

        return redirect(route("manageproduct.index"))->with("successDeleteProduct", "The product has been removed from your shop.");
    }
}
