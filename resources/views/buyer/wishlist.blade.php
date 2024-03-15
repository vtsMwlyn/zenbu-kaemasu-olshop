@extends("layouts.main")

@section("content")
    @if(session()->has("successAddWishlist"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session("successAddWishlist") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session()->has("successRemoveWishlist"))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session("successRemoveWishlist") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session()->has("unsuccessRemoveWishlist"))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session("unsuccessRemoveWishlist") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session()->has("failAddWishlistSelf"))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session("failAddWishlistSelf") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session()->has("failAddWishlistExist"))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session("failAddWishlistExist") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h3 class="text-zktheme-title text-center mb-4">My Wishlist</h3>

    @if(auth()->user()->wishlist->count())
        <div class="mt-3 row">
            @foreach(auth()->user()->wishlist as $product)
                <div class="col-md-3 mb-5">
                    <div class="card">
                        <form action={{ route("wishlist.destroy", $product->slug) }} method="post">
                            @csrf
                            @method("delete")
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
                                <form action={{ route("cart.index") }} method="post">
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
        <div class="d-flex flex-column align-items-center position-relative top-50 start-50 translate-middle">
            <img src={{ asset("res/image/emptywishlist.png") }} alt="Empty cart" width="200px">
            <h6 class="fst-italic text-center my-5">Your have never added any items to your wishlist. Let's find some products that you will like!</h6>
        </div>
    @endif

@endsection
