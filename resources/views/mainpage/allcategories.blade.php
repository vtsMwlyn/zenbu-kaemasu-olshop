@extends("layouts.main")

@section("content")
    <h3 class="text-zktheme-title text-center mb-4">All Product Categories</h3>

    @foreach($categories as $category)
        <div class="hstack">
            <h5 class="text-zktheme-subtitle">{{ $category->category_name }}</h5>
            <a href="/categories/{{ $category->slug }}" class="text-zktheme-subtitle text-decoration-none ms-auto">See all</a>
        </div>

        @if($category->products->count())
            <div class="mt-3 row">
                @foreach($category->products as $product)
                    @if($loop->iteration == 5)
                        @break
                    @endif

                    <div class="col-md-3 mb-5">
                        <div class="card">
                            @auth
                                <form action="/wishlist" method="post">
                                    @csrf
                                    <input type="hidden" name="prodslug" id="prodslug" value="{{ $product->slug }}">
                                    <button type="submit" class="position-absolute top-0 end-0 text-danger bg-transparent border-0"><i class="bi bi-heart-fill fs-3"></i></button>
                                </form>
                            @else
                                <a href="/login"><i class="bi bi-heart-fill position-absolute top-0 end-0 me-2 text-danger fs-3"></i></a>
                            @endif

                            @if($product->prodimg_path)
                                <img src={{ asset("storage/" . $product->prodimg_path) }} class="card-img-top border-bottom" height="250px" alt="Default product image">
                            @else
                                <img src={{ asset("res/image/defaultproductimage.jpg") }} class="card-img-top border-bottom" height="250px" alt="Default product image">
                            @endif

                            <div class="card-body">
                                <div class="product-display-card-desc">
                                    <h5 class="card-title"><a href="/productdetails/{{ $product->slug }}" class="text-decoration-none text-dark">{{ $product->product_name }}</a></h5>
                                    <p class="fst-italic text-secondary fs-6 mt-1">by {{ $product->seller->userDetail->username }}</p>
                                </div>

                                <div class="mt-3">
                                    <p class="card-text fw-semibold"><i class="bi bi-star-fill text-warning"></i> Not yet rated</p>
                                    <p class="card-text fw-semibold"><i class="bi bi-cash-stack text-success"></i> Rp {{ number_format($product->price) }}.00</p>
                                    @auth
                                        <form action="/cart" method="post">
                                            @csrf
                                            <input type="hidden" name="prodslug" id="prodslug" value="{{ $product->slug }}">
                                            <button type="submit" class="btn btn-primary w-100 mt-2">Buy</button>
                                        </form>
                                    @else
                                        <a href="/login" class="btn btn-primary w-100 mt-2">Buy</a>
                                    @endauth
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
