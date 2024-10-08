@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Product</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}">
        </div>

        <div class="form-group mb-3">
            <label for="slug">Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug', $product->slug) }}">
        </div>

        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}">
        </div>

        <div class="form-group mb-3">
            <label for="thumbnail">Thumbnail</label>
            <input type="file" name="thumbnail" class="form-control">
            <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="Thumbnail" width="100" class="mt-2">
        </div>

        <div class="form-group mb-3">
            <label for="quantity_limit">Quantity Limit</label>
            <input type="number" name="quantity_limit" class="form-control" value="{{ old('quantity_limit', $product->quantity_limit) }}">
        </div>

        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Inactive</option>
                <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Active</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
