@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Create Product</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="form-group mb-3">
            <label for="slug">Slug</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
        </div>

        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" value="{{ old('price') }}">
        </div>

        <div class="form-group mb-3">
            <label for="thumbnail">Thumbnail</label>
            <input type="file" name="thumbnail" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="quantity_limit">Quantity Limit</label>
            <input type="number" name="quantity_limit" class="form-control" value="{{ old('quantity_limit') }}">
        </div>

        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
