@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header d-flex justify-content-between align-items-center p-2">
        <h6 class="m-2 font-weight-bold text-primary d-inline fs-5">Бүтээгдэхүүн Засах</h6>
        <a href="{{ route('admin.product.index') }}" class="btn btn-primary float-end">Буцах</a>
    </div>

    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Tabs for different sections -->
            <ul class="nav nav-tabs" id="productTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                            data-bs-target="#home-tab-pane" type="button" role="tab"
                            aria-controls="home-tab-pane" aria-selected="true">
                        Нүүр
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                            data-bs-target="#details-tab-pane" type="button" role="tab"
                            aria-controls="details-tab-pane" aria-selected="false">
                        Дэлгэрэнгүй
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="image-tab" data-bs-toggle="tab"
                            data-bs-target="#image-tab-pane" type="button" role="tab"
                            aria-controls="image-tab-pane" aria-selected="false">
                        Бүтээгдэхүүний Зураг
                    </button>
                </li>
            </ul>

            <!-- Tab content -->
            <div class="tab-content" id="productTabContent">
                <!-- Home Tab -->
                <div class="tab-pane fade border p-3 show active" id="home-tab-pane" role="tabpanel"
                     aria-labelledby="home-tab">
                    <!-- Product Name -->
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Категори</label>
                        <select name="category_id" class="form-control" required>
                            <option>Категори сонгох</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Бүтээгдэхүүн нэр</label>
                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name', $product->name) }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div class="mb-3">
                        <label>Товчлол</label>
                        <input type="text" name="slug" class="form-control" placeholder="Товчлол" value="{{ old('slug', $product->slug) }}">
                        @error('slug')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label>Тайлбар</label>
                        <textarea name="description" class="form-control" placeholder="Description">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Details Tab -->
                <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel"
                     aria-labelledby="details-tab">
                    <div class="row">
                        <!-- Price -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label>Үнэ</label>
                                <input type="number" name="price" class="form-control" placeholder="Үнэ" value="{{ old('price', $product->price) }}">
                                @error('price')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Sale Percent -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label>Хямдралын хувь</label>
                                <input type="number" name="sale_percent" class="form-control" placeholder="Хямдралын хувь" value="{{ old('sale_percent', $product->sale_percent) }}">
                                @error('sale_percent')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Quantity -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label>Тооны Хязгаар</label>
                                <input type="number" name="quantity_limit" class="form-control" placeholder="Тоо хэмжээ" value="{{ old('quantity_limit', $product->quantity_limit) }}">
                                @error('quantity_limit')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label>Статус</label>
                                <select name="status" class="form-control">
                                    <option value="0" {{ old('status', $product->status) == '0' ? 'selected' : '' }}>Ил</option>
                                    <option value="1" {{ old('status', $product->status) == '1' ? 'selected' : '' }}>Нууц</option>
                                </select>
                                @error('status')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Tab -->
                <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel"
                     aria-labelledby="image-tab">
                    <!-- Thumbnail (Image Upload) -->
                    <div class="mb-3">
                        <label>Зураг</label>
                        <input type="file" name="thumbnail" class="form-control">
                        @error('thumbnail')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                        @if ($product->thumbnail)
                            <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}" class="img-thumbnail mt-2" width="100">
                        @endif
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-3">
                <button type="submit" class="btn btn-primary float-end">Хадгалах</button>
            </div>

        </form>
    </div>
</div>
@endsection
