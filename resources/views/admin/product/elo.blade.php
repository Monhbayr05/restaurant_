<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Шинэ Бүтээгдэхүүн</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12"></div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <!-- Product Name -->
                                        <div class="mb-3">
                                            <label>Бүтээгдэхүүн нэр</label>
                                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
                                            @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Slug -->
                                        <div class="mb-3">
                                            <label>Товчлол</label>
                                            <input type="text" name="slug" class="form-control" placeholder="Товчлол" value="{{ old('slug') }}">
                                            @error('slug')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Description -->
                                        <div class="mb-3">
                                            <label>Тайлбар</label>
                                            <textarea name="description" class="form-control" placeholder="Description">{{ old('description') }}</textarea>
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
                                        </div>

                                        <!-- Price -->
                                        <div class="mb-3">
                                            <label>Үнэ</label>
                                            <input type="number" name="price" class="form-control" placeholder="Үнэ" value="{{ old('price') }}">
                                            @error('price')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Sale Percent -->
                                        <div class="mb-3">
                                            <label>Хямдралын хувь</label>
                                            <input type="number" name="sale_percent" class="form-control" placeholder="Хямдралын хувь" value="{{ old('sale_percent') }}">
                                            @error('sale_percent')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Quantity -->
                                        <div class="mb-3">
                                            <label>Тоо хэмжээ</label>
                                            <input type="number" name="quantity" class="form-control" placeholder="Тоо хэмжээ" value="{{ old('quantity') }}">
                                            @error('quantity')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Status (Active/Inactive) -->
                                        <div class="mb-3">
                                            <label>Статус</label>
                                            <select name="status" class="form-control">
                                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Идэвхтэй</option>
                                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Идэвхгүй</option>
                                            </select>
                                            @error('status')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Trending -->
                                        <div class="mb-3">
                                            <label>Эрэлттэй эсэх</label>
                                            <select name="trending" class="form-control">
                                                <option value="1" {{ old('trending') == '1' ? 'selected' : '' }}>Эрэлттэй</option>
                                                <option value="0" {{ old('trending') == '0' ? 'selected' : '' }}>Эрэлттэй бус</option>
                                            </select>
                                            @error('trending')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-2">
                                            <button type="submit" class="btn btn-primary">Хадгалах</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
