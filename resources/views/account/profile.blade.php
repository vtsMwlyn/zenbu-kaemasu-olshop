@extends("layouts.main")

@section("content")
    <div class="bg-light rounded py-3 px-5 mx-5 mt-3 mb-5">
        <h4 class="text-zktheme-title text-center mt-1 mb-3">My Profile</h4>
        @if(session()->has("successUpdateProfile"))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session("successUpdateProfile") }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action={{ route("profile.update") }} method="post" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <div class="col">
                    <label for="real_name" class="form-label text-zktheme-label">Real Name</label>
                    <input type="real_name" name="real_name" class="form-control @error("real_name") is-invalid @enderror" id="real_name" value="{{ old("real_name", $userDetail->real_name) }}">
                    @error("real_name")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col">
                    <label for="dob" class="form-label text-zktheme-label fs-6">Date of Birth</label>
                    <input type="dob" name="dob" class="form-control @error("dob") is-invalid @enderror" id="dob" placeholder="dobs available to sell" value="{{ old("dob", $userDetail->dob) }}">
                    @error("dob")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="email" class="form-label text-zktheme-label">Email Address</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ old("email", auth()->user()->email) }}" disabled>
                </div>
                <div class="col">
                    <label for="phone" class="form-label text-zktheme-label fs-6">Phone Number</label>
                    <input type="phone" name="phone" class="form-control @error("phone") is-invalid @enderror" id="phone" placeholder="phones available to sell" value="{{ old("phone", $userDetail->phone) }}">
                    @error("phone")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="mb-3">
                    <label for="address" class="form-label text-zktheme-label">Address</label>
                    <input type="address" name="address" class="form-control @error("address") is-invalid @enderror" id="address" value="{{ old("address", $userDetail->address) }}">
                    @error("address")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div>
                    <label for="profpic_path" class="form-label">Profile Picture</label>
                    <div class="@error("profpic_path") border rounded border-danger @enderror">
                        @if($userDetail->profpic_path)
                            <img src={{ asset("storage/" . $userDetail->profpic_path) }} class="img-preview img-fluid d-block col-sm-5 mb-3">
                        @else
                            <img class="img-preview img-fluid d-block col-sm-5">
                        @endif
                        <input class="form-control" type="file" id="profpic_path" name="profpic_path" onChange="previewImage()">
                    </div>
                    @error("profpic_path")
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>

            <input type="hidden" name="username" id="username" value="{{ $userDetail->username }}">
            <input type="hidden" name="oldImage" id="oldImage" value="{{ $userDetail->profpic_path }}">

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary my-4 col-3 ms-auto" id="finishBtn">Finish</button>
            </div>
        </form>

    </div>

    <script type="text/javascript">
        const inpRealName = document.getElementById("real_name");
        const inpUsername = document.getElementById("username");

        inpRealName.addEventListener("change", function(){
            inpUsername.value = inpRealName.value.replaceAll(" ", "-").toLowerCase();
            console.log(inpUsername.value);
        });

        function previewImage(){
            const image = document.querySelector("#profpic_path");
            const imgPrev = document.querySelector(".img-preview")

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imgPrev.src = oFREvent.target.result;
            }

            imgPrev.style.marginBottom = imgPrev.className += " mb-3";
        }

    </script>

@endsection
