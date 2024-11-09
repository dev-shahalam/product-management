@extends('layout')
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h2 class="pb-2 border-bottom border-secondary mb-3">Product Management</h2>
            <a href="{{ route('create-product') }}" class="btn btn-primary mb-4">Add Product</a>

            @if ($errors->any())
                <div id="notification">
                    @foreach ($errors->all() as $error)
                        <p class="alert alert-danger ">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if (session()->has('success'))
                <div id="notification" class=" row justify-content-center">
                    <div class="position-absolute top-50 start-50 translate-middle col-sm-3 alert alert-success text-center text-black"
                         role="alert">
                        {{ session()->get('success') }}
                    </div>
                </div>
            @endif

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>{{ $product->product_id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <img src="{{asset($product->image) }}" alt="{{$product->name }}" width="100">
                        </td>
                                                <td>
                                                       <a href="{{ route('edit-product', ['id' => $product->id]) }}" class="btn btn-success">Update</a>
                                                       <a href="{{ route('delete-product', ['id' => $product->id]) }}" class="btn btn-danger">Delete</a>
                                                    </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
