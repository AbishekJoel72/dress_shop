@extends('layouts.admin.default')
@section('content')
    <div class="container">

        <style>
            /* File input style */
            input[type="file"].d-none {
                display: none;
            }

            .custom-file-upload {
                width: 100%;
                height: 200px;
                border: 2px dashed #0092ca;
                border-radius: 6px;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                color: #0092ca;
                font-size: 16px;
                font-weight: 600;
                background-color: #fdfdfd;
                cursor: pointer;
                transition: 0.3s ease;
                overflow: hidden;
                text-align: center;
            }

            .custom-file-upload:hover {
                background-color: #f0f9fc;
                border-color: #007ea7;
            }

            .custom-file-upload i {
                font-size: 32px;
                margin-bottom: 8px;
            }

            /* Preview image inside box */
            .custom-file-upload img {
                width: 100%;
                height: 100%;
                object-fit: contain;
            }

            /* Label style */
            label {
                font-weight: 600;
                color: #333;
                margin-bottom: 5px;
                display: block;
            }
        </style>


        <form action="{{ route('update_products') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="Product_update" value="true">
            <input type="hidden" name="id" value="{{ $product->id }}">

            <div class="card">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-2">
                    @if ($product->id)
                        <h5 class="mb-0">Edit Product</h5>
                    @else
                        <h5 class="mb-0">Add Product</h5>
                    @endif

                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-10">
                            <div class="row">
                                <div class="col">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" name="product_name" id="product_name" class="form-control"
                                        value="{{ old('product_name', $product->product_name) }}" required>
                                </div>

                                <div class="col">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" id="category_id" class="form-select">
                                        <option value="" selected disabled>Select Category</option>
                                        @foreach ($category as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $item->id == $product->category_id ? 'selected' : '' }}>
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>

                                </div>


                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" id="price" class="form-control"
                                        value="{{ old('price', $product->price) }}" required>
                                </div>

                                <div class="col">
                                    <label for="discount_price">Discount Price</label>
                                    <input type="number" name="discount_price" id="discount_price"
                                        value="{{ old('discount_price', $product->discount_price) }}" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="row mt-3">


                                <div class="col-6">
                                    <label for="stock">Stock</label>
                                    <input type="number" name="stock" id="stock" class="form-control"
                                        value="{{ old('stock', $product->stock) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-2">


                            <div class="form-group mt-4">
                                <input type="file" name="image_path" id="image_path" class="d-none" accept="image/*"
                                    onchange="previewImage(event)">
                                <label for="image_path" class="custom-file-upload" id="uploadBox">
                                    @if ($product->image_path)
                                        <img src="{{ asset($product->image_path) }}" alt="Product Image">
                                    @else
                                        <i class="fa fa-cloud-upload"></i>
                                        <span>Choose File</span>
                                    @endif
                                </label>


                            </div>
                        </div>
                        <div class="col-10">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" rows="4" class="form-control" required>{{ old('description', $product->description) }}</textarea>

                        </div>

                    </div>

                </div>
                <div class="card-footer bg-transparent text-center">
                    @if ($product->id)
                          <button type="submit" class="btn btn-primary"><i class="fa-solid fa-pen">

                            </i> Update</button>
                        <button type="reset" class="btn btn-secondary"><i class="fa-solid fa-rotate-left"></i>
                            Reset</button>
                    @else
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk">
                            </i> Submit</button>
                        <button type="reset" class="btn btn-secondary"><i class="fa-solid fa-rotate-left"></i>
                            Reset</button>
                    @endif

                </div>

            </div>
        </form>

    </div>
    @include('layouts.footer')
@endsection
@section('script')
    @include('layouts.datatable')
    <script>
        function previewImage(event) {
            let file = event.target.files[0];
            let uploadBox = document.getElementById("uploadBox");

            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {

                    uploadBox.innerHTML = "";

                    // Create image and add
                    let img = document.createElement("img");
                    img.src = e.target.result;

                    uploadBox.appendChild(img);
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
