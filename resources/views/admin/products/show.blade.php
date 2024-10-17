@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Product Details</h2>

            <div class="card-body">
                @if ($product->getMedia('image')->isNotEmpty())
                    <img src="{{ $product->getFirstMediaUrl('image') }}"  class="img-fluid" style="height: 300px; object-fit: cover;">
                @else
                    <img src="{{ asset('image.jpg') }}" alt="Default Image" class="img-fluid" style="height: 300px; object-fit: cover;">
                @endif
                <p><strong>Name:</strong> {{ $product->name }}</p>
                <p><strong>Description:</strong> {{ $product->description }}</p>
                <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                <p><strong>Star Rating:</strong> {{ $product->star_rating }}</p>
                <p><strong>Category:</strong> {{ $product->category->name }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">Edit Product</a>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete Product</button>
                </form>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
            </div>
        </div>
    </div>
@endsection
