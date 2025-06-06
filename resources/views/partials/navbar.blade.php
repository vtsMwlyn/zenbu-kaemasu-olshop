<div class="fixed-top">
    <nav class="navbar navbar-expand-lg bg-zktheme-blue py-2">
        <div class="container-fluid">
            <!--Brand and sidebar toogler-->
            <div class="navbar-brand">
                <button class="border-0 bg-transparent dropdown-toggle text-light" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar, #fakesidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle sidebar">
                    <img src={{ asset("res/image/logowithtext.png") }} alt="Logo" width="140px">
                </button>
            </div>

            <!--Navbar toogler-->
            <button class="navbar-toggler border-2 border-light focus-ring" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="--bs-focus-ring-color: rgba(var(--bs-light-rgb), .25)">
                <i class="bi bi-list text-light"></i>
            </button>

            <div class="collapse navbar-collapse gap-4" id="navbarSupportedContent" data-bs-parent="#nafubaa">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::is("products*") && !request("category"))? "text-zktheme-selected fw-bold" : "text-light" }}" aria-current="page" href={{ route("products") }}>Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::is("categories*") || (Request::is("products") && request("category")))? "text-zktheme-selected fw-bold" : "text-light" }}" href={{ route("categories") }}>Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is("about*")? "text-zktheme-selected fw-bold" : "text-light" }}" href={{ route("about") }}>About</a>
                    </li>
                </ul>

                @if(Request::is("categories"))
                    <form class="d-flex col" action={{ route("categories") }}>
                @elseif(Request::is("products*"))
                    <form class="d-flex col" action={{ route("products") }}>
                @elseif(Request::is("categories/*"))
                    <form class="d-flex col" action={{ route("products") }}>
                @endif
                    <div class="input-group">
                        <button type="submit" class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></button>
                        @if(Request::is("categories/*"))
                            <input type="hidden" name="category" id="category" value="{{ $currCategory->slug }}">
                            <input type="text" class="form-control" placeholder="Search products in {{ $currCategory->category_name }}..." name="search" id="search" value="{{ request("search") }}">
                        @elseif(Request::is("categories"))
                            <input type="text" class="form-control" placeholder="Search categories..." name="search" id="search" value="{{ request("search") }}">
                        @else
                            <input type="text" class="form-control" placeholder="Search products..." name="search" id="search" value="{{ request("search") }}">
                        @endif
                    </div>
                </form>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown gap-2">
                        @if(!auth()->guest())
                            <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Welcome, {{ auth()->user()->userDetail->real_name }}!
                                @if(!auth()->guest() && auth()->user()->userDetail->profpic_path)
                                    <img src={{ asset("storage/" . auth()->user()->userDetail->profpic_path) }} alt="profpic" width="65px" height="65px" class="rounded-circle">
                                @else
                                    <img src={{ asset("res/image/blankprofilepictureround.png") }} alt="profpic" width="70px" height="70px">
                                @endif
                            </a>

                            <ul class="dropdown-menu position-absolute">
                                <li><a class="dropdown-item" href={{ route("profile") }}>Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action={{ route("logout") }} method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</buttonn>
                                    </form>
                                </li>
                            </ul>

                        @else
                            <a class="nav-link text-light" href={{ route("login") }}><i class="bi bi-box-arrow-in-right"></i> Login <img src={{ asset("res/image/blankprofilepictureround.png") }} alt="profpic" width="70px" height="70px"></a>
                        @endif
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    @include("partials.sidebar")
</div>
