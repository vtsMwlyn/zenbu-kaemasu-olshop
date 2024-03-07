@extends("layouts.main")

@section("content")
    @if(session()->has("successAddCart"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session("successAddCart") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session()->has("successRemoveCart"))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session("successRemoveCart") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session()->has("unsuccessRemoveCart"))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session("unsuccessRemoveCart") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session()->has("failAddCartSelf"))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session("failAddCartSelf") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session()->has("failAddCartExist"))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session("failAddCartExist") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h3 class="text-zktheme-title text-center mb-4">My Cart</h3>

    @if(auth()->user()->cart->count())
        <div class="mt-3 row" style="padding-bottom: 90px;">
            @foreach(auth()->user()->cart as $product)
                <div class="card mb-3 ps-0">
                    <div class="row">
                        <div class="col-md-3">
                            @if($product->prodimg_path)
                                <img src={{ asset("storage/" . $product->prodimg_path) }} class="img-fluid rounded-start" height="200px" alt="Default product image">
                            @else
                                <img src={{ asset("res/image/defaultproductimage.jpg") }} class="img-flui rounded-start" height="200px" alt="Default product image">
                            @endif
                        </div>
                        <div class="col d-flex align-items-center">
                            <div class="d-flex flex-column d-inline-block">
                                <h5 class="fw-bold"><a href="/productdetails/{{ $product->slug }}" class="text-decoration-none text-dark">{{ $product->product_name }}</a></h5>
                                <p class="fst-italic text-secondary fs-6">by {{ $product->seller->userDetail->username }}</p>
                                <p class="card-text fw-semibold"><i class="bi bi-star-fill text-warning"></i> Not yet rated</p>

                                <form>
                                    <input type="hidden" id="item-price" value="{{ $product->price }}">
                                </form>

                                <p class="fw-bold fs-4">Rp {{ number_format($product->price) }}.00</p>
                            </div>
                            <div class="d-flex ms-auto me-5">
                                <button type="submit" id="minusButton_{{ $loop->iteration }}" class="btn btn-primary rounded-0 rounded-start" onClick="subtractItem({{ $loop->iteration }});"><i class="bi bi-dash-lg"></i></button>
                                <input class="fw-bold bg-light form-control d-inline rounded-0 cart-item-num-input text-center" id="itemNum_{{ $loop->iteration }}" value="1">
                                <button type="submit" id="addButton_{{ $loop->iteration }}" class="btn btn-primary rounded-0 rounded-end" onClick="addItem({{ $loop->iteration }});"><i class="bi bi-plus-lg"></i></button>

                            </div>
                            <form action="/cart/{{ $product->slug }}" method="post">
                                @csrf
                                @method("delete")
                                <button type="submit" class="btn btn-danger me-5 remove-item-btn"><i class="bi bi-trash3-fill"></i> Remove</button>
                            </form>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>

        <div class="bg-white fixed-bottom p-3 border row z-0">
            <div class="col d-flex flex-row justify-content-center">
                <div class="d-flex flex-column">
                    <span class="fw-bold">Subtotal:</span>
                    <span id="subtotal">Rp 0.00</span>
                </div>
            </div>
            <div class="col d-flex align-items-center justify-content-end me-5">
                <a href="#" class="btn btn-success w-50"><i class="bi bi-bag-check-fill"></i> Checkout</a>
            </div>

            <script type="text/javascript" src={{ asset("res/code/js/cart.js") }}></script>

        </div>

    @else
        <div class="d-flex flex-column align-items-center position-relative top-50 start-50 translate-middle">
            <img src={{ asset("res/image/emptycart.png") }} alt="Empty cart" width="200px">
            <h6 class="fst-italic text-center my-5">Your cart is empty. Let's buy some product and add them to your cart!</h6>
        </div>
    @endif

@endsection
