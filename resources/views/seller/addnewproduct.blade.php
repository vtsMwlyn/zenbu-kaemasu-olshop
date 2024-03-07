@extends("layouts.main")

@section("content")
    <div class="bg-light rounded py-3 px-5 mx-5 mt-3 mb-5">
        <h4 class="text-zktheme-title text-center mt-1 mb-3">Add New Product</h4>

        <form action="/manage-products" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="mb-3">
                    <label for="productname" class="form-label text-zktheme-label">Product name</label>
                    <input type="productname" name="productname" class="form-control @error("productname") is-invalid @enderror" id="productname" placeholder="Your product name" value="{{ old("productname") }}">
                    @error("productname")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="price" class="form-label text-zktheme-label">Product price</label>
                    <input type="price" name="price" class="form-control @error("price") is-invalid @enderror" id="price" placeholder="Price of your product" value="{{ old("price") }}">
                    @error("price")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col">
                    <label for="stock" class="form-label text-zktheme-label fs-6">Product stock</label>
                    <input type="stock" name="stock" class="form-control @error("stock") is-invalid @enderror" id="stock" placeholder="Stocks available to sell" value="{{ old("stock") }}">
                    @error("stock")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="category" class="form-label">Product category</label>
                <div>
                    <div class="@error("category") border rounded border-danger @enderror">
                        <select class="form-select" id="category" name="category">
                            <option disabled selected>Select your product category</option>
                            @foreach($categories as $c)
                                @if(old("category") == $c->id)
                                    <option value="{{ $c->id }}" selected>{{ $c->category_name }}</option>
                                @else
                                    <option value="{{ $c->id }}">{{ $c->category_name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                @error("category")
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="row mb-3">
                <div>
                    <label for="image" class="form-label">Product Image</label>
                    <div class="@error("category") border rounded border-danger @enderror">
                        <img class="img-preview img-fluid d-block col-sm-5">
                        <input class="form-control" type="file" id="image" name="image" onChange="previewImage()">
                    </div>
                    @error("image")
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div>
                    <label for="description" class="form-label">Product description</label>
                    <div>
                        {{-- <label for="description" class="form-label">Product description</label>
                        <textarea class="form-control @error("description") is-invalid @enderror" id="description" name="description" rows="10" placeholder="Describe your product here" style="resize: none;">{{ old("description") }}</textarea>
                        @error("description")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror --}}

                        <input type="hidden" id="description" name="description" value="{{ old("description") }}">
                        <trix-editor input="description" class="@error("description") border rounded border-danger @enderror bg-white"></trix-editor>

                    </div>
                    @error("description")
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>

            <input type="hidden" name="slug" id="slug" value="slug">

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary my-4 col-3 ms-auto">Finish</button>
            </div>
        </form>

    </div>

    <script type="text/javascript">
        const inpProductName = document.getElementById("productname");
        const inpSlug = document.getElementById("slug");

        inpProductName.addEventListener("change", function(){
            inpSlug.value = inpProductName.value.replaceAll(" ", "-").toLowerCase();
            console.log(inpSlug.value);
        });

        function previewImage(){
            const image = document.querySelector("#image");
            const imgPrev = document.querySelector(".img-preview")

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imgPrev.src = oFREvent.target.result;
            }

            imgPrev.style.marginBottom = imgPrev.className += " mb-3";
        }

        document.addEventListener("trix-file-accept", function(e){
            e.preventDefault();
        })

    </script>


@endsection
