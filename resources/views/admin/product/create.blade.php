@extends('layouts.admin')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <!-- Page Heading -->
            <div class="col-md-6">
                <h3>Бүтээгдэхүүн</h3>
                <p class="text-subtitle text-muted">Бүтээгдэхүүн нэмэх эсвэл удирдах</p>
            </div>
            <!-- Breadcrumb -->
            <div class="col-md-6 text-end">
                <nav aria-label="breadcrumb" class="breadcrumb-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Бүтээгдэхүүн Жагсаалт</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Бүтээгдэхүүн Нэмэх</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Бүтээгдэхүүн Нэмэх</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Display Errors -->
                            @if ($errors->any())
                                <div class="alert alert-warning">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Product Form -->
                            <form class="form" action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <!-- Thumbnail Upload -->
                                    <div class="col-md-6 text-center">
                                        <div class="form-group">
                                            <label for="thumbnail" class="form-label">Thumbnail Зураг</label>
                                            <div class="image-upload-wrapper position-relative">
                                                <img 
                                                    id="thumbnailPreview" 
                                                    src="https://via.placeholder.com/200" 
                                                    alt="Thumbnail Preview" 
                                                    class="img-thumbnail"
                                                    style="width: 200px; height: 200px; object-fit: cover; cursor: pointer;" />
                                                <button 
                                                    type="button" 
                                                    class="btn btn-primary btn-sm position-absolute top-50 start-50 translate-middle" 
                                                    onclick="document.getElementById('thumbnail').click()" 
                                                    style="border-radius: 50%;">
                                                    +
                                                </button>
                                            </div>
                                            <input 
                                                type="file" 
                                                id="thumbnail" 
                                                name="thumbnail" 
                                                class="form-control d-none" 
                                                accept="image/*" 
                                                onchange="previewThumbnail(event)" />
                                        </div>
                                    </div>

                                    <!-- Product Information -->
                                    <div class="col-md-6">
                                        <!-- Category -->
                                        <div class="mb-3">
                                            <label for="category_id" class="form-label">Категори</label>
                                            <select name="category_id" id="category_id" class="form-control" required>
                                                <option value="" selected disabled>Категори сонгох</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Name -->
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Бүтээгдэхүүний Нэр</label>
                                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                                        </div>

                                        <!-- Status -->
                                        <div class="form-check form-switch">
                                            <input type="checkbox" name="status" class="form-check-input" id="status" {{ old('status') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status">Ил болгох</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <!-- Slug -->
                                    <div class="col-md-6">
                                        <label for="slug" class="form-label">Товчлол</label>
                                        <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug') }}" required>
                                    </div>

                                    <!-- Quantity Limit -->
                                    <div class="col-md-6">
                                        <label for="quantity_limit" class="form-label">Тооны Хязгаар</label>
                                        <input type="number" id="quantity_limit" name="quantity_limit" class="form-control" value="{{ old('quantity_limit') }}" min="1" required>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <!-- Description -->
                                    <div class="col-md-12">
                                        <label for="description" class="form-label">Тодорхойлолт</label>
                                        <textarea id="description" name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <!-- Sale Percent -->
                                    <div class="col-md-4">
                                        <label for="sale_percent" class="form-label">Хямдралын Хувь</label>
                                        <input type="number" id="sale_percent" name="sale_percent" class="form-control" value="{{ old('sale_percent') }}" max="100">
                                    </div>

                                    <!-- Price -->
                                    <div class="col-md-4">
                                        <label for="price" class="form-label">Үнэ</label>
                                        <input type="number" id="price" name="price" class="form-control" value="{{ old('price') }}" min="1" required>
                                    </div>

                                    <!-- Quantity -->
                                    <div class="col-md-4">
                                        <label for="quantity" class="form-label">Тоо хэмжээ</label>
                                        <input type="number" id="quantity" name="quantity" class="form-control" value="{{ old('quantity') }}" min="1" required>
                                    </div>
                                </div>

                                <!-- Form Buttons -->
                                <div class="col-12 d-flex justify-content-center pt-4">
                                    <button type="submit" class="btn btn-primary me-2">Хадгалах</button>
                                    <button type="reset" class="btn btn-secondary">Буцах</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function previewThumbnail(event) {
        const reader = new FileReader();
        reader.onload = function () {
            document.getElementById('thumbnailPreview').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
