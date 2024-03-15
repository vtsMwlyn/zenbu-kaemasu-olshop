@extends("layouts.main2")

@section("container")
    <div class="container d-flex flex-column align-items-center">
        <img src={{ asset("res/image/logowithtext.png") }} alt="Logo Zenbu Kaemasu Olshop" width="200px" class="mb-3">

        <div class="bg-light rounded py-3 px-4 col-sm-6">
            <h4 class="text-zktheme-title text-center mt-1 mb-3">Please login to continue</h4>

            @if(session()->has("loginError"))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session("loginError") }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session()->has("successCreateAccount"))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session("successCreateAccount") }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action={{ route("login.store") }} method="post">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label text-zktheme-label">Email</label>
                    <input type="email" name="email" class="form-control @error("email") is-invalid @enderror" id="email" placeholder="Enter your email" value="{{ old("email") }}">
                    @error("email")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-zktheme-label fs-6">Password</label>
                    <input type="password" name="password" class="form-control @error("password") is-invalid @enderror" id="password" placeholder="Enter your password" value="{{ old("password") }}">
                    @error("password")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100 my-4">Sign In</button>
            </form>

            <p class="text-center"><a href={{ route("register") }} class="text-decoration-none">Don't have an account? Register here!</a></p>

        </div>
    </div>


@endsection
