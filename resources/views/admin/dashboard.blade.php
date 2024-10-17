@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Welcome to the Admin Dashboard</h2>
        <div class="mb-3">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-secondary">Add Category</a>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
    <h3>Product List</h3>
    @if ($products->isEmpty())
        <p>No products found. Add a product to get started!</p>
    @else
        <table class="table table-bordered">

            <tbody>
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-3 mb-4">
                            <div class="card h-100">
                                <div class="position-relative">
                                    @if ($product->getMedia('image')->isNotEmpty())
                                        <img src="{{ $product->getFirstMediaUrl('image') }}" class="card-img-top"
                                            alt="{{ $product->name }}" style="height: 300px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('image.jpg') }}" class="card-img-top"
                                            style="height: 300px; object-fit: cover;">
                                    @endif
                                </div>
                                
                                <div class="card-body">
                                    <h5 class="card-title">Product Name: {{ $product->name }}</h5>
                                    <h5 class="card-rate">Rating: {{ $product->star_rating }}</h5>
                                    <p class="card-text">Price: ₹ {{ number_format($product->price) }}</p>
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                    <a href="{{ route('admin.products.show', $product) }}"
                                        class="btn btn-outline-secondary btn-sm">View Details</a>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </tbody>
        </table>
    @endif
    </div>
@endsection
