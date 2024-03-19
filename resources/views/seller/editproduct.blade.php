@extends("layouts.main")

@section("content")
    <div class="container d-flex flex-column align-items-center bg-light rounded py-3 mt-3 mb-5">
        <h4 class="text-zktheme-title text-center mt-1 mb-3">Edit Product</h4>
        <form action={{ route("manageproduct.update", $product->slug) }} method="post" enctype="multipart/form-data" class="col-sm-11">
            @csrf
            @method("put")
            <div class="">
                <div class="mb-3">
                    <label for="productname" class="form-label text-zktheme-label">Product name</label>
                    <input type="productname" name="productname" class="form-control @error("productname") is-invalid @enderror" id="productname" placeholder="Your product name" value="{{ old("productname", $product->product_name) }}">
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
                    <input type="price" name="price" class="form-control @error("price") is-invalid @enderror" id="price" placeholder="Price of your product" value="{{ old("price", $product->price) }}">
                    @error("price")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col">
                    <label for="stock" class="form-label text-zktheme-label fs-6">Product stock</label>
                    <input type="stock" name="stock" class="form-control @error("stock") is-invalid @enderror" id="stock" placeholder="Stocks available to sell" value="{{ old("stock", $product->stock) }}">
                    @error("stock")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <div>
                    <label for="checkbox" class="form-label">Product category</label>
                    <div class="@error("checkbox") border rounded border-danger @enderror">
                        <div class="d-flex flex-wrap gap-3">
                            @foreach($categories as $c)
                                <div class="col d-flex gap-2">
                                    @if($flags[$loop->iteration - 1])
                                        <input class="form-check-input" type="checkbox" value={{ $c->id }} id="checkbox{{ $loop->iteration }}" name="checkbox[]" checked>
                                    @else
                                        <input class="form-check-input" type="checkbox" value={{ $c->id }} id="checkbox{{ $loop->iteration }}" name="checkbox[]">
                                    @endif
                                    <label class="form-check-label" for="checkbox{{ $loop->iteration }}">
                                        {{ $c->category_name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @error("checkbox")
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <div>
                    <label for="image" class="form-label">Product Image</label>
                    <div class="@error("category") border rounded border-danger @enderror">
                        @if($product->prodimg_path)
                            <img src={{ asset("storage/" . $product->prodimg_path) }} class="img-preview img-fluid d-block col-sm-3 mb-3">
                        @else
                            <img class="img-preview img-fluid d-block col-sm-3">
                        @endif
                        <input class="form-control" type="file" id="image" name="image" onChange="previewImage()">
                    </div>
                    @error("image")
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
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

                        <input type="hidden" id="description" name="description" value="{{ old("description", $product->desc) }}">
                        <trix-editor input="description" class="@error("description") border rounded border-danger @enderror bg-white"></trix-editor>

                    </div>
                    @error("description")
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>

            <input type="hidden" name="slug" id="slug" value="{{ $product->slug }}">
            <input type="hidden" name="oldImage" id="oldImage" value="{{ $product->prodimg_path }}">

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary my-4 col-3 ms-auto" id="finishBtn">Finish</button>
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

    </script>


@endsection
