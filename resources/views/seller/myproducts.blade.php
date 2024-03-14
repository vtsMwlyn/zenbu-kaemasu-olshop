@extends("layouts.main")

@section("content")
    <h3 class="text-zktheme-title text-center mb-4">My Products</h3>

    @if(session()->has("successAddProduct"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session("successAddProduct") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session()->has("successUpdateProduct"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session("successUpdateProduct") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session()->has("successDeleteProduct"))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session("successDeleteProduct") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="mt-5 row">
        @foreach($products as $product)
            <div class="col-md-3 mb-5">
                <div class="card">
                    @if($product->prodimg_path)
                        <img src={{ asset("storage/" . $product->prodimg_path) }} class="card-img-top border-bottom" height="250px" alt="Default product image">
                    @else
                        <img src={{ asset("res/image/defaultproductimage.jpg") }} class="card-img-top border-bottom" height="250px" alt="Default product image">
                    @endif
                    <div class="card-body">
                        <div class="product-display-card-desc-manageproduct">
                            <h5 class="card-title">{{ $product->product_name }}</h5>
                            <p class="fst-italic text-secondary fs-6">in {{ $product->categories[0]->category_name }}</p>
                            <p class="card-text">Rp {{ number_format($product->price) }}.00</p>
                        </div>
                        <div class="mx-0 mt-2">
                            <div class="d-flex flex-wrap column-gap-1">
                                <a href={{ route("productdetails", $product->slug) }} class="btn btn-success text-light"><i class="bi bi-eye"></i></a>
                                <a href={{ route("manageproduct.edit", $product->slug) }} class="btn btn-warning text-light"><i class="bi bi-pencil"></i></a>
                                <form method="post" action={{ route("manageproduct.destroy", $product->slug) }} class="d-inline">
                                    @method("delete")
                                    @csrf
                                    <button class="btn btn-danger" onclick="return confirm('This product will be deleted. Are you sure?')"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>


@endsection
