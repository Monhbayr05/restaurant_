@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header d-flex justify-content-between align-items-center p-2">
        <h6 class="m-2 font-weight-bold text-primary d-inline fs-5">Бүтээгдэхүүн Нэмэх</h6>
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
        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

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
                    <!-- Category -->
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Категори</label>
                        <select name="category_id" class="form-control" required>
                            <option>Категори сонгох</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Product Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Бүтээгдэхүүний Нэр</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>

                    <!-- Product Slug -->
                    <div class="mb-3">
                        <label for="slug" class="form-label">Товчлол</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
                    </div>

                    <!-- Product Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Тодорхойлолт</label>
                        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                    </div>
                </div>

                <!-- Details Tab -->
                <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel"
                     aria-labelledby="details-tab">
                    <div class="row">
                        <!-- Sale Percent -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="sale_percent" class="form-label">Хямдралын Хувь</label>
                                <input type="number" name="sale_percent" class="form-control"
                                       value="{{ old('sale_percent') }}" max="100">
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="price" class="form-label">Үнэ</label>
                                <input type="number" name="price" class="form-control"
                                       value="{{ old('price') }}" min="1">
                            </div>
                        </div>

                        <!-- Quantity -->
                        <div class="col-md-4">
                            <!-- Quantity Limit -->
                            <div class="mb-3">
                                <label for="quantity_limit" class="form-label">Тооны Хязгаар</label>
                                <input type="number" name="quantity_limit" class="form-control" value="{{ old('quantity_limit') }}">
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <label>Ил бол дарна уу?</label>
                                <input type="checkbox" name="status" {{old('status') ? 'checked' : ''}}>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Tab -->
                <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel"
                     aria-labelledby="image-tab">
                    <!-- Thumbnail -->
                    <div class="mb-3">
                        <label for="thumbnail">Thumbnail Зураг</label>
                        <input type="file" name="thumbnail" class="form-control">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-3">
                <button type="submit" class="btn btn-primary float-end">Илгээх</button>
            </div>

        </form>
    </div>
</div>
@endsection
