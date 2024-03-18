@extends("layouts.main")

@section("content")
    <h3 class="text-zktheme-title text-center mb-4">All Product Categories</h3>

    <div class="d-flex flex-wrap my-5 gap-3 justify-content-center align-items-center">
        @foreach($categories as $category)
            <a href={{ route("productbycategory", $category->slug) }} class="btn btn-success" style="width: 160px">{{ $category->category_name }}</a>
        @endforeach
    </div>

    @foreach($categories as $category)
        <div class="hstack">
            <h5 class="text-zktheme-subtitle">{{ $category->category_name }}</h5>
            <a href={{ route("productbycategory", $category->slug) }} class="text-zktheme-subtitle text-decoration-none ms-auto">See all</a>
        </div>
        @if($category->products->count())
            <div class="mt-3 d-flex flex-wrap justify-content-center gap-3">
                @foreach($category->products as $product)
                    @if($loop->iteration == 5)
                        @break
                    @endif

                    <div class="mb-5" style="width: 300px">
                        <div class="card">
                            <form action={{ route("wishlist.store") }} method="post">
                                @csrf
                                <input type="hidden" name="prodslug" id="prodslug" value="{{ $product->slug }}">
                                <button type="submit" class="position-absolute top-0 end-0 text-danger bg-transparent border-0"><i class="bi bi-heart-fill fs-3"></i></button>
                            </form>

                            @if($product->prodimg_path)
                                <img src={{ asset("storage/" . $product->prodimg_path) }} class="card-img-top border-bottom" height="250px" alt="Default product image">
                            @else
                                <img src={{ asset("res/image/defaultproductimage.jpg") }} class="card-img-top border-bottom" height="250px" alt="Default product image">
                            @endif

                            <div class="card-body">
                                <div class="product-display-card-desc">
                                    <h5 class="card-title"><a href={{ route("productdetails", $product->slug) }} class="text-decoration-none text-dark">{{ $product->product_name }}</a></h5>
                                    <p class="fst-italic text-secondary fs-6 mt-1">by {{ $product->seller->userDetail->username }}</p>
                                </div>

                                <div class="mt-3">
                                    <p class="card-text fw-semibold"><i class="bi bi-star-fill text-warning"></i> Not yet rated</p>
                                    <p class="card-text fw-semibold"><i class="bi bi-cash-stack text-success"></i> Rp {{ number_format($product->price) }}.00</p>

                                    <form action={{ route("cart.store") }} method="post">
                                        @csrf
                                        <input type="hidden" name="prodslug" id="prodslug" value="{{ $product->slug }}">
                                        <button type="submit" class="btn btn-primary w-100 mt-2">Buy</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>

        @else
            <h6 class="fst-italic text-center my-5">No products found</h6>
        @endif

    @endforeach

@endsection
