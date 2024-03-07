@extends("layouts.main")

@section("content")
    <h3 class="text-zktheme-title text-center mb-4">All Products</h3>

    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <h1 class="position-absolute text-light p-3 card-image-corner-label">Discover your desired products</h1>
                <img src={{ asset("res/image/carousell1.jpg") }} class="d-block w-100" height="400px" alt="Carousell Image 1">
            </div>
            <div class="carousel-item">
                <h1 class="position-absolute text-light p-3 card-image-corner-label">Enjoy a lot of benefits</h1>
                <img src={{ asset("res/image/carousell2.png") }} class="d-block w-100" height="400px" alt="Carousell Image 2">
            </div>
            <div class="carousel-item">
                <h1 class="position-absolute text-light p-3 card-image-corner-label">Anywhere and anytime</h1>
                <img src={{ asset("res/image/carousell3.jpg") }} class="d-block w-100" height="400px" alt="Carousell Image 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    @if($products->count())
        <div class="my-5 row">
            @foreach($products as $product)
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
                        @endauth

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

@endsection
