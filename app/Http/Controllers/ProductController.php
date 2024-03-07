<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller{
    public function index(){
        $this->authorize("seller");

        return view("seller.myproducts", [
            "products" => Product::where("seller_id", auth()->user()->id)->get()
        ]);
    }

    public function create(){
        return view("seller.addnewproduct", [
            "categories" => Category::all()
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            "productname" => "required",
            "price" => "required|numeric|gt:0",
            "stock" => "required|numeric|gt:0",
            "image" => "required|file|image|max:4096",
            "description" => "required",
            "slug" => "required",
            "category" => "required"
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

        $newProductCategoryData = [
            "product_id" => $createdProductData->id,
            "category_id" => $validatedData["category"]
        ];

        ProductCategory::create($newProductCategoryData);

        return redirect("/manage-products")->with("successAddProduct", "Successfully added a new product!");
    }

    public function show(Product $product){

    }

    public function edit($slug){
        return view("seller.editproduct", [
            "product" => Product::where("slug", $slug)->get()[0],
            "categories" => Category::all()
        ]);
    }

    public function update(Request $request, $slug){
        $product = Product::where("slug", $slug)->get()[0];

        $validatedUpdateData = $request->validate([
            "productname" => "required",
            "price" => "required|numeric|gt:0",
            "stock" => "required|numeric|gt:0",
            "image" => "file|image|max:4096",
            "slug" => "required",
            "description" => "required",
            "category" => "required"
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

        if(Product::where("slug", $validatedUpdateData["slug"])->exists() || $product->slug == $validatedUpdateData["slug"]){
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

        $pctg = ProductCategory::where("product_id", $product->id)->get()[0];
        $newProductCategoryData = [
            "product_id" => $product->id,
            "category_id" => Category::where("id", $validatedUpdateData["category"])->get()[0]->id
        ];
        ProductCategory::where("id", $pctg->id)->update($newProductCategoryData);

        return redirect("/manage-products")->with("successUpdateProduct", "Product successfully updated!");
    }

    public function destroy($slug){
        $product = Product::where("slug", $slug)->get()[0];

        if($product->prodimg_path){
            Storage::delete($product->prodimg_path);
        }

        $pctg = ProductCategory::where("product_id", $product->id)->get()[0];
        ProductCategory::destroy($pctg->id);
        Product::destroy($product->id);

        return redirect("/manage-products")->with("successDeleteProduct", "The product has been removed from your shop.");
    }
}
