<div class="p-4 bg-zktheme-dark-blue col-sm-2 collapse" id="sidebar">
    <div>
        <div class="border-light">
            <span class="text-light fw-bold">Menu</span>
        </div>

        <hr class="text-light">

        <div class="d-flex flex-column mt-2">
            {{-- <span class="my-2"><a href={{ (auth()->guest())? "/login" : "/cart" }} class="text-decoration-none {{ Request::is("cart*")? "text-zktheme-selected fw-bold" : "text-light" }}"><i class="bi bi-cart3"></i> Cart</a></span> --}}
            {{-- <span class="my-2"><a href={{ (auth()->guest())? "/login" : route("wishlist.index") }} class="text-decoration-none {{ Request::is("wishlist*")? "text-zktheme-selected fw-bold" : "text-light" }}"><i class="bi bi-heart-fill"></i> Wishlist</a></span> --}}
            <span class="my-2"><a href={{ route("cart.index") }} class="text-decoration-none {{ Request::is("cart*")? "text-zktheme-selected fw-bold" : "text-light" }}"><i class="bi bi-cart3"></i> Cart</a></span>
            <span class="my-2"><a href={{ route("wishlist.index") }} class="text-decoration-none {{ Request::is("wishlist*")? "text-zktheme-selected fw-bold" : "text-light" }}"><i class="bi bi-heart-fill"></i> Wishlist</a></span>
        </div>
    </div>

    @can("seller")
        <div class="mt-4">
            <div class="border-light">
                <span class="text-light fw-bold">My Shop</span>
            </div>

            <hr class="text-light">

            <div class="d-flex flex-column mt-2">
                <span class="my-2"><a href={{ route("manageproduct.index") }} class="text-decoration-none {{ (Request::is("manage-products") || Request::is("manage-products/*/edit")) ? "text-zktheme-selected fw-bold" : "text-light" }}">
                    <i class="bi bi-box-seam"></i> Manage Products
                </a></span>
                <span class="my-2"><a href={{ route("manageproduct.create") }} class="text-decoration-none {{ Request::is("manage-products/create")? "text-zktheme-selected fw-bold" : "text-light" }}">
                    <i class="bi bi-bag-plus-fill"></i> Add New Product
                </a></span>
                <span class="my-2"><a href="#" class="text-decoration-none text-light">
                    <i class="bi bi-bar-chart-fill"></i> Shop Statistics
                </a></span>
            </div>
        </div>
    @endcan


</div>
