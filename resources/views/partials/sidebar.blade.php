<div class="col-2 align-items-start h-100 fixed-top px-4 h-100 sidebar-container">
    <div>
        <div class="border-light border-bottom pb-2">
            <span class="text-light fw-bold">Menu</span>
        </div>

        <div class="d-flex flex-column mt-2">
            <span class="my-2"><a href={{ (auth()->guest())? "/login" : "/cart" }} class="text-decoration-none {{ Request::is("cart*")? "text-zktheme-selected fw-bold" : "text-light" }}"><i class="bi bi-cart3"></i> Cart</a></span>
            <span class="my-2"><a href={{ (auth()->guest())? "/login" : "/wishlist" }} class="text-decoration-none {{ Request::is("wishlist*")? "text-zktheme-selected fw-bold" : "text-light" }}"><i class="bi bi-heart-fill"></i> Wishlist</a></span>
        </div>
    </div>

    @can("seller")
        <div class="mt-4">
            <div class="border-light border-bottom pb-2">
                <span class="text-light fw-bold">My Shop</span>
            </div>

            <div class="d-flex flex-column mt-2">
                <span class="my-2"><a href="/manage-products" class="text-decoration-none {{ (Request::is("manage-products") || Request::is("manage-products/*/edit")) ? "text-zktheme-selected fw-bold" : "text-light" }}">
                    <i class="bi bi-box-seam"></i> Manage Products
                </a></span>
                <span class="my-2"><a href="/manage-products/create" class="text-decoration-none {{ Request::is("manage-products/create")? "text-zktheme-selected fw-bold" : "text-light" }}">
                    <i class="bi bi-bag-plus-fill"></i> Add New Product
                </a></span>
                <span class="my-2"><a href="#" class="text-decoration-none text-light">
                    <i class="bi bi-bar-chart-fill"></i> Shop Statistics
                </a></span>
            </div>
        </div>
    @endcan

</div>
