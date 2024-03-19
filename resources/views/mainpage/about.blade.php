@extends("layouts.main")

@section("content")
    <div class="container bg-light rounded border py-3 mb-4">
        <div class="d-flex justify-content-center my-3">
            <img src={{ asset("res/image/ZenbuKaemasuLogo.png") }} alt="Logo Zenbu Kaemasu Olshop" width="150px">
            <div class="d-flex flex-column text-center d-inline justify-content-center">
                <div>
                    <span class="text-zktheme-subtitle fw-bold fs-1 d-block" style="margin-right: 90px;">Zenbu</span>
                    <span class="text-zktheme-subtitle position-relative fw-bold fs-1" style="margin-left: 90px; top: -10px;">Kaemasu</span>
                </div>
                <span class="text-zktheme-subtitle fw-semibold fs-4 position-relative" style="top: -10px;">O n l i n e S h o p</span>
            </div>
        </div>

        <h3 class="text-zktheme-title text-center mt-4">About Us</h3>
        <img src={{ asset("res/image/ZKolshopLandingPage.png") }} alt="Beeg image" class="img-fluid img-thumbnail my-3">
        <p class="text-center my-3">Zenbu Kaemasu Online Shop is an e-commerce established in 2024 by its founder, Mr. Vannes Theo Sudarsono, S.Si, during his learning in web application development using Laravel php framework. This web application is a place where people can do online shopping with various of products and their categories available. It has features such as creating new account and logging in using the new account, see all products and their categories, searching for some product using keywords, viewing product details, and adding products to cart and/or wishlist. The user is also can be a seller where they are will be able to add new products, modify their products, or even remove their products from their shop. We hope that this web application can be developed further to make its usage and contribution to society will become bigger and better. Happy shopping!</p>

        <h3 class="text-zktheme-title text-center mt-5 mb-4">Contact Us</h3>
        <div class="d-flex column-gap-5 row-gap-3 flex-wrap justify-content-center">
            <div class="d-flex align-items-center gap-2">
                <img src={{ asset("res/image/linelogo.webp") }} alt="Logo" class="medsos-logo">
                <span>vts_vatheno</span>
            </div>
            <div class="d-flex align-items-center gap-2">
                <img src={{ asset("res/image/instagramlogo.png") }} alt="Logo" class="medsos-logo">
                <span>vts.mwlyn</span>
            </div>
            <div class="d-flex align-items-center gap-2">
                <img src={{ asset("res/image/facebooklogo.png") }} alt="Logo" class="medsos-logo">
                <span>Vannes Theo S</span>
            </div>

            <div class="d-flex align-items-center gap-2">
                <img src={{ asset("res/image/twitterlogo.png") }} alt="Logo" class="medsos-logo">
                <span>@TheoVannes</span>
            </div>
            <div class="d-flex align-items-center gap-2">
                <img src={{ asset("res/image/whatsapplogo.png") }} alt="Logo" class="medsos-logo">
                <span>+62 811-1111-6857</span>
            </div>
            <div class="d-flex align-items-center gap-2">
                <img src={{ asset("res/image/gmaillogo.webp") }} alt="Logo" class="medsos-logo">
                <span>vannestheo@gmail.com</span>
            </div>
        </div>
        <hr class="mt-5">
        <h6 class="text-zktheme-subtitle text-center fw-bold mt-4 mb-2">Copyright &#169; 2024 - Zenbu Kaemasu Online Shop</h3>
    </div>
@endsection
