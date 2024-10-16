@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Products
                        <a href="{{ route('admin.product.index') }}" class="btn btn-primary btn-sm float-end">BACK</a>
                    </h4>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-warning">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Tabs for different sections -->
                        <ul class="nav nav-tabs" id="productTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#home-tab-pane" type="button" role="tab"
                                        aria-controls="home-tab-pane" aria-selected="true">
                                    Home
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                        data-bs-target="#details-tab-pane" type="button" role="tab"
                                        aria-controls="details-tab-pane" aria-selected="false">
                                    Details
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab" data-bs-toggle="tab"
                                        data-bs-target="#image-tab-pane" type="button" role="tab"
                                        aria-controls="image-tab-pane" aria-selected="false">
                                    Product Image
                                </button>
                            </li>
                        </ul>

                        <!-- Tab content -->
                        <div class="tab-content" id="productTabContent">
                            <!-- Home Tab -->
                            <div class="tab-pane fade border p-3 show active" id="home-tab-pane" role="tabpanel"
                                 aria-labelledby="home-tab">
                                <!-- Category -->
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select name="category_id" class="form-control" required>
                                        <option>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Product Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Product Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                </div>

                                <!-- Product Slug -->
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Product Slug</label>
                                    <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
                                </div>

{{--                                quantity limit--}}
                                <div class="mb-3">
                                    <label for="quantity_limit" class="form-label">Quantity Limit</label>
                                    <input type="text" name="quantity_limit" class="form-control" value="{{ old('quantity_limit') }}">
                                </div>

                                <!-- Product Description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description"
                                              class="form-control">{{ old('description') }}</textarea>
                                </div>
                            </div>

                            <!-- Details Tab -->
                            <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel"
                                 aria-labelledby="details-tab">
                                <div class="row">
                                    <!-- Sale Percent -->
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="sale_percent" class="form-label">Sale Percent</label>
                                            <input type="number" name="sale_percent" class="form-control"
                                                   value="{{ old('sale_percent') }}" max="100">
                                        </div>
                                    </div>

                                    <!-- Price -->
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Price</label>
                                            <input type="number" name="price" class="form-control"
                                                   value="{{ old('price') }}" min="1">
                                        </div>
                                    </div>

                                    <!-- Quantity -->
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="quantity" class="form-label">Quantity</label>
                                            <input type="number" name="quantity" class="form-control"
                                                   value="{{ old('quantity') }}" min="1">
                                        </div>
                                    </div>



                                    <!-- Status -->
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="status">Status</label>
                                            <label>Is Public or Private</label>
                                            <input type="checkbox" name="status" {{old('status') ? 'checked' : ''}}>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel"
                                 aria-labelledby="image-tab">
                                <!-- Thumbnail -->
                                <div class="mb-3">
                                    <label for="thumbnail">Upload Product Thumbnail</label>
                                    <input type="file" name="thumbnail" class="form-control">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary float-end">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
