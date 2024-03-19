@extends("layouts.main")

@section("content")
    <div class="row d-flex justify-content-between flex-wrap-reverse mb-4 row-gap-3">
        <div class="col-sm-7 d-flex flex-column">
            <h5 class="text-zktheme-subtitle mb-3">Product Details</h5>
            <div class="bg-white rounded p-3 flex-grow-1 mt-2" style="max-height: 520px; overflow: auto;">
                {!! $product->desc !!}
            </div>
        </div>

        <div class="col-sm-4 p-0">
            <div class="bg-white h-auto pb-2 position-relative">
                <form action={{ route("wishlist.store") }} method="post">
                    @csrf
                    <input type="hidden" name="prodslug" id="prodslug" value="{{ $product->slug }}">
                    <button type="submit" class="text-danger bg-transparent border-0 position-absolute top-0 end-0"><i class="bi bi-heart-fill fs-3"></i></button>
                </form>

                @if($product->prodimg_path)
                    <img src={{ asset("storage/" . $product->prodimg_path) }} class="w-100" alt="Default product image" height="288px">
                @else
                    <img src={{ asset("res/image/defaultproductimage.jpg") }} class="w-100" alt="Default product image">
                @endif

                <div class="my-3 px-3">
                    <h5 class="card-title">{{ $product->product_name }}</h5>
                    <p class="fst-italic text-secondary fs-6 mt-2">by {{ $product->seller->userDetail->username }}</p>
                    <p class="card-text fw-semibold"><i class="bi bi-star-fill text-warning"></i> Not yet rated</p>
                    <p class="fw-bold fs-5"><i class="bi bi-cash-stack text-success"></i> Rp {{ number_format($product->price) }}.00</p>
                    <p class="fs-6">Stocks available: {{ $product->stock }}</p>

                    @auth
                        <form action={{ route("cart.index") }} method="post">
                            @csrf
                            <input type="hidden" name="prodslug" id="prodslug" value="{{ $product->slug }}">
                            <button type="submit" class="btn btn-primary w-100 mt-2">Buy</button>
                        </form>
                    @else
                        <a href={{ route("cart.store") }} class="btn btn-primary w-100 mt-2">Buy</a>
                    @endauth
                </div>
            </div>

        </div>
    </div>

    <h5 class="text-zktheme-subtitle mt-5 mb-4">Comments and Ratings</h5>
    <p class="text-secondary">Sorry, this feature is currently unavailable</p>

    <h5 class="text-zktheme-subtitle mt-5 mb-4">Other Related Products</h5>
    <div class="d-flex flex-wrap justify-content-center gap-3">
        @foreach($otherproducts as $p)
            @if($p->product_name == $product->product_name || $p->categories[0]->id != $product->categories[0]->id)
                @continue
            @else
                <div class="mb-5" style="width: 300px">
                    <div class="card">
                        <form action={{ route("wishlist.store") }} method="post">
                            @csrf
                            <input type="hidden" name="prodslug" id="prodslug" value="{{ $p->slug }}">
                            <button type="submit" class="position-absolute top-0 end-0 text-danger bg-transparent border-0"><i class="bi bi-heart-fill fs-3"></i></button>
                        </form>

                        @if($p->prodimg_path)
                            <img src={{ asset("storage/" . $p->prodimg_path) }} class="card-img-top border-bottom" height="250px" alt="Default product image">
                        @else
                            <img src={{ asset("res/image/defaultproductimage.jpg") }} class="card-img-top border-bottom" height="250px" alt="Default product image">
                        @endif

                        <div class="card-body">
                            <div class="product-display-card-desc">
                                <h5 class="card-title"><a href={{ route("productdetails", $p->slug) }} class="text-decoration-none text-dark">{{ $p->product_name }}</a></h5>
                                <p class="fst-italic text-secondary fs-6 mt-1">by {{ $p->seller->userDetail->username }}</p>
                            </div>
                            <div class="mt-3">
                                <p class="card-text fw-semibold"><i class="bi bi-star-fill text-warning"></i> Not yet rated</p>
                                <p class="card-text fw-semibold"><i class="bi bi-cash-stack text-success"></i> Rp {{ number_format($p->price) }}.00</p>

                                <form action={{ route("cart.store") }} method="post">
                                    @csrf
                                    <input type="hidden" name="prodslug" id="prodslug" value="{{ $p->slug }}">
                                    <button type="submit" class="btn btn-primary w-100 mt-2">Buy</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endsection
