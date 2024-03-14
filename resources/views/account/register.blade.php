@extends("layouts.main2")

@section("container")
    <div class="d-flex align-items-center justify-content-center" style="height: 100vh">
        <div class="d-flex flex-column align-items-center">
            <img src={{ asset("res/image/logowithtext.png") }} alt="Logo Zenbu Kaemasu Olshop" width="200px" class="mb-3">

            <div class="bg-light rounded py-3 px-4" style="width: 60vw;">
                <h4 class="text-zktheme-title text-center mt-1 mb-3">Create New Account</h4>

                <form action={{ route("register.store") }} method="post">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="name" class="form-label text-zktheme-label">Name</label>
                                <input type="name" name="name" class="form-control @error("name") is-invalid @enderror" id="name" placeholder="Enter your name" value="{{ old("name") }}">
                                @error("name")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label text-zktheme-label fs-6">Email</label>
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
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="dob" class="form-label text-zktheme-label">Date of Birth</label>
                                <input type="dob" name="dob" class="form-control @error("dob") is-invalid @enderror" id="dob" placeholder="Enter your day of birth" value="{{ old("dob") }}">
                                @error("dob")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label text-zktheme-label fs-6">Address</label>
                                <input type="address" name="address" class="form-control @error("address") is-invalid @enderror" id="address" placeholder="Enter your address" value="{{ old("address") }}">
                                @error("address")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label text-zktheme-label fs-6">Phone Number</label>
                                <input type="phone" name="phone" class="form-control @error("phone") is-invalid @enderror" id="phone" placeholder="Enter your phone number" value="{{ old("phone") }}">
                                @error("phone")
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="username" id="username" value="user">

                    <button type="submit" class="btn btn-primary w-100 my-4">Sign Up</button>
                </form>

                <p class="text-center"><a href={{ route("login") }} class="text-decoration-none">Already have an account? Sign in here!</a></p>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        const inpName = document.getElementById("name");
        const inpUsername = document.getElementById("username");

        inpName.addEventListener("change", function(){
            inpUsername.value = inpName.value.replaceAll(" ", "-").toLowerCase();
            console.log(inpUsername.value);
        });

    </script>

@endsection
