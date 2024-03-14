@extends("layouts.main")

@section("content")
    <h3 class="text-zktheme-title text-center mb-4">{{ $title }}</h3>

    @if($category->products->count())
        <div class="mt-3 row px-4">
            @foreach($category->products as $product)
                <div class="col-md-3 mb-5">
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

@endsection
