@extends('layout')

@section('content')
    <div class="container mt-5 ">
        <div class="row  justify-content-center align-items-center">
            <div class="col-8 border-bottom border-secondary mb-3">
                <h2 class="mb-4">Create New Product</h2>
            </div>
            <div class="col-8 ">

                @if ($errors->any())
                    <div id="notification">
                        @foreach ($errors->all() as $error)
                            <p class="alert alert-danger ">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="mb-3 col-4">
                            <label for="product_id" class="form-label">Product ID</label>
                            <input type="text" class="form-control" id="product_id" name="product_id"
                                value="{{ old('product_id') }}">
                        </div>
                        <div class="mb-3 col-8">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-6">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01"
                                value="{{ old('price') }}">
                        </div>

                        <div class="mb-3 col-6">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock"
                                value="{{ old('stock') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <img id="imagePreview" class="img-fluid img-thumbnail w-25 mb-3"
                            src="{{ asset('uploads/demo-image.png') }}" alt="">
                        <br>
                        <label for="image" class="form-label">Product Image</label>
                        <input onchange="previewImage(event)" id="image" type="file" class="form-control"
                            id="image" name="image">
                    </div>

                    <button type="submit" class="btn btn-primary">Create Product</button>
                    <a href="{{ route('products') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>

        </div>
    </div>


    {{-- Image Preveiw --}}

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

@endsection
