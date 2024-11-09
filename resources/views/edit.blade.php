@extends('layout')
@section('content')

    <div class="container mt-5 ">
        <div class="row  justify-content-center align-items-center">
            <div class="col-8 border-bottom border-secondary mb-3">
                <h2 class="mb-4">Update Product </h2>
            </div>
            <div class="col-8 ">

                @if ($errors->any())
                    <div id="notification">
                        @foreach ($errors->all() as $error)
                            <p class="alert alert-danger ">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('update-product',['id'=> $product->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="mb-3 col-4">
                            <label for="product_id" class="form-label">Product ID</label>
                            <input disabled value="{{ $product->product_id }}" type="text" class="form-control"
                                id="product_id" name="product_id">
                        </div>
                        <div class="mb-3 col-8">
                            <label for="name" class="form-label">Product Name</label>
                            <input value="{{ $product->name }}" type="text" class="form-control" id="name"
                                name="name">
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="price" class="form-label">Price</label>
                            <input value="{{ $product->price }}" type="number" class="form-control" id="price"
                                name="price" step="0.01">
                        </div>

                        <div class="mb-3 col-6">
                            <label for="stock" class="form-label">Stock</label>
                            <input value="{{ $product->stock }}" type="number" class="form-control" id="stock"
                                name="stock">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4">{{ $product->description }}</textarea>
                    </div>

                    <div class="mb-3">

                        <div class="mb-3">
                        <img id="imagePreview" class="img-fluid img-thumbnail w-25 mb-3"
                        src="{{ asset($product->image) }}" alt="">
                            <br>
                            <label for="image" class="form-label">Product Image</label>
                            <input onchange="previewImage(event)" id="image" type="file" class="form-control"
                            name="image">
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">Update Product</button>
                    <a href="{{ route('products') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>

        </div>
    </div>

    <script>
        function previewImage(event) {
            const imagePreview = document.getElementById('imagePreview');
            const file = event.target.files[0];
            if (file) {
                // Show the image preview
                imagePreview.style.display = 'block';
                imagePreview.src = URL.createObjectURL(file);
                // Clean up URL object after image loads
                imagePreview.onload = () => {
                    URL.revokeObjectURL(imagePreview.src); // Free up memory
                };
            }
        }
    </script>

    @if (session()->has('success'))
        <div id="notification" class=" row justify-content-center">
            <div class="position-absolute top-50 start-50 translate-middle col-sm-3 alert alert-success text-center text-black"
                role="alert">
                {{ session()->get('success') }}
            </div>
        </div>
    @endif

@endsection
