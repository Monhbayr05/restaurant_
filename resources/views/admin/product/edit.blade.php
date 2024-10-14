@extends('layouts.admin')

@section('content')
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <!-- Edit Product -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Бүтээгдэхүүн Засах</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Product Name -->
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

                        <!-- Price -->
                        <div class="mb-3">
                            <label>Үнэ</label>
                            <input type="number" name="price" class="form-control" placeholder="Үнэ" value="{{ old('price', $product->price) }}">
                            @error('price')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Sale Percent -->
                        <div class="mb-3">
                            <label>Хямдралын хувь</label>
                            <input type="number" name="sale_percent" class="form-control" placeholder="Хямдралын хувь" value="{{ old('sale_percent', $product->sale_percent) }}">
                            @error('sale_percent')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Quantity -->
                        <div class="mb-3">
                            <label>Тоо хэмжээ</label>
                            <input type="number" name="quantity" class="form-control" placeholder="Тоо хэмжээ" value="{{ old('quantity', $product->quantity) }}">
                            @error('quantity')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Status (Active/Inactive) -->
                        <div class="mb-3">
                            <label>Статус</label>
                            <select name="status" class="form-control">
                                <option value="0" {{ old('status', $product->status) == '0' ? 'selected' : '' }}>Идэвхтэй</option>
                                <option value="1" {{ old('status', $product->status) == '1' ? 'selected' : '' }}>Идэвхгүй</option>
                            </select>
                            @error('status')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Trending -->
                        <div class="mb-3">
                            <label>Эрэлттэй эсэх</label>
                            <select name="trending" class="form-control">
                                <option value="1" {{ old('trending', $product->trending) == '1' ? 'selected' : '' }}>Эрэлттэй</option>
                                <option value="0" {{ old('trending', $product->trending) == '0' ? 'selected' : '' }}>Эрэлттэй бус</option>
                            </select>
                            @error('trending')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <button type="submit" class="btn btn-primary">Хадгалах</button>
                            <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">Буцах</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
