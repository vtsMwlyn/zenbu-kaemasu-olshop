@extends("layouts.main")

@section("content")
    <div class="row">
        <div class="col-8 pe-5">
            <h5 class="text-zktheme-subtitle mb-3">Product Details</h5>
            {!! $product->desc !!}

            <h5 class="text-zktheme-subtitle mt-4 mb-3">Other Products</h5>
            <div>
                @foreach($otherproducts as $p)
                    @if($p->product_name == $product->product_name)
                        @continue
                    @else
                        <div class="card mb-3 d-flex flex-row">
                            <div>
                                @if($p->prodimg_path)
                                    <img src={{ asset("storage/" . $p->prodimg_path) }} class="img-fluid rounded-start" alt="Default product image">
                                @else
                                    <img src={{ asset("res/image/defaultproductimage.jpg") }} class="img-fluid rounded-start" alt="Default product image">
                                @endif
                            </div>

                            <div class="col-md-10 px-3 d-flex align-items-center">
                                <div class="d-flex flex-column">
                                    <h5 class="fw-semibold"><a href={{ route("productdetails", $product->slug) }} class="text-decoration-none text-dark">{{ $p->product_name }}</a></h5>
                                    <span class="fw-bold fs-6"><i class="bi bi-cash-stack text-success"></i> Rp {{ number_format($p->price) }}.00</span>
                                </div>

                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="col-4 p-0">
            <div class="bg-white h-auto pb-2 sticky-top">
                <form action={{ route("wishlist.store") }} method="post">
                    @csrf
                    <input type="hidden" name="prodslug" id="prodslug" value="{{ $product->slug }}">
                    <button type="submit" class="position-absolute top-0 end-0 me-2 text-danger bg-transparent border-0"><i class="bi bi-heart-fill fs-3"></i></button>
                </form>

                @if($product->prodimg_path)
                    <img src={{ asset("storage/" . $product->prodimg_path) }} class="w-100" alt="Default product image">
                @else
                    <img src={{ asset("res/image/defaultproductimage.jpg") }} class="w-100" alt="Default product image">
                @endif

                <div class="my-3 px-3">
                    <h4 class="card-title">{{ $product->product_name }}</h4>
                    <p class="fst-italic text-secondary fs-6 mt-2">by {{ $product->seller->userDetail->username }}</p>
                    <p class="fw-bold fs-4"><i class="bi bi-cash-stack text-success"></i> Rp {{ number_format($product->price) }}.00</p>
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
@endsection
