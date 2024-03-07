<nav class="navbar navbar-expand-lg bg-zktheme-blue py-0 px-2 fixed-top z-1">
    <div class="container-fluid">
        <div class="navbar-brand">
            <img src={{ asset("res/image/logowithtext.png") }} alt="Logo" width="160px">
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is("products*")? "text-zktheme-selected fw-bold" : "text-light" }}" aria-current="page" href="/products">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is("categories*")? "text-zktheme-selected fw-bold" : "text-light" }}" href="/categories">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is("about*")? "text-zktheme-selected fw-bold" : "text-light" }}" href="/about">About</a>
                </li>
            </ul>

            <form class="d-flex col-5 mx-3" action="/products">
                <div class="input-group">
                    <button type="submit" class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></button>
                    <input type="text" class="form-control" placeholder="Search products..." name="search" id="search">
                </div>
            </form>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    @if(!auth()->guest())
                        <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Welcome back, {{ auth()->user()->userDetail->real_name }}!
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/profile">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</buttonn>
                                </form>
                            </li>
                        </ul>
                    @else
                        <a class="nav-link text-light" href="/login"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                    @endif
                </li>
            </ul>

            @if(!auth()->guest() && auth()->user()->userDetail->profpic_path)
                <img src={{ asset("storage/" . auth()->user()->userDetail->profpic_path) }} alt="profpic" width="65px" height="65px" class="rounded-circle">
            @else
                <img src={{ asset("res/image/blankprofilepictureround.png") }} alt="profpic" width="70px" height="70px">
            @endif

        </div>
    </div>
</nav>
