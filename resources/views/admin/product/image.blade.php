@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>{{ $product->name }} - Images</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.product.storeImage', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label for="image">Add Product Images</label>
                <input type="file" name="image[]" class="form-control" multiple accept="image/*">
                <small class="form-text text-muted">You can upload multiple images.</small>
            </div>

            <button type="submit" class="btn btn-primary">Upload</button>
        </form>

        <h2 class="mt-4">Existing Images</h2>
        <div class="row">
            @if($product->productImages && $product->productImages->count() > 0)
                @foreach($product->productImages as $image)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="{{ asset($image->image) }}" class="card-img-top" alt="Product Image" width="250px" height="200px">
                            <div class="card-body">
                                <form action="{{ route('admin.product.imageDestroy', $image->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No images available for this product.</p>
            @endif
        </div>

    </div>
@endsection
