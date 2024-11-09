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

             <!-- Sort Links -->
        <div class="mb-3">
            <a href="{{ route('products', ['sort' => 'name', 'direction' => $direction == 'asc' ? 'desc' : 'asc']) }}">Sort by Name</a>
            | <a href="{{ route('products', ['sort' => 'price', 'direction' => $direction == 'asc' ? 'desc' : 'asc']) }}">Sort by Price</a>
             <!-- Search Form -->
        <form method="GET" action="{{ route('products') }}" class="mb-3">
            <input type="text" name="search" value="{{ old('search', $search) }}" class="form-control" placeholder="Search by Product ID or Description">
            <button type="submit" class="btn btn-primary mt-2">Search</button>
        </form>
        </div>

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
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->product_id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td><img src="{{$product->image}}" alt="{{asset($product->image)}}" width="100">
                        </td>
                                                <td>
                                                    <a href="{{ route('view-product', ['id' => $product->id]) }}"
                                                       class="btn btn-primary">View</a>
                           <a href="{{ route('edit-product', ['id' => $product->id]) }}" class="btn btn-success">Update</a>
                           <a href="{{ route('delete-product', ['id' => $product->id]) }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{-- Pagination Links --}}
            <div class="mt-4">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
