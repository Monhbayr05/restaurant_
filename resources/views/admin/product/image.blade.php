@extends('layouts.admin')

@section('content')
    <div class="container">
        <a href="{{ route('admin.product.index') }}" class="btn btn-secondary mb-3">Буцах</a>
        <h1>{{ $product->name }} <span class="fs-3 opacity-50">- Бүтээгдэхүүний зургууд</span></h1>


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

        <form action="{{ route('admin.product.storeImage', $product->id) }}" method="POST" enctype="multipart/form-data" class="">
            @csrf

            <div class="form-group mb-3">
                <label for="image">Бүтээгдэхүүний Зургийг Нэмэх</label>
                <input type="file" name="image[]" class="form-control" multiple accept="image/*">
                <small class="form-text text-muted">Та олон зураг оруулж болно.</small>
            </div>

            <button type="submit" class="btn btn-primary">Оруулах</button>
        </form>

        <h2 class="mt-4">Оруулсан зургууд</h2>
        <div class="row">
            @if($product->productImages && $product->productImages->count() > 0)
                @foreach($product->productImages as $image)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="{{ asset($image->image) }}" class="card-img-top" alt="Бүтээгдэхүүний Зураг" width="250px" height="200px">
                            <div class="card-body">
                                <form action="{{ route('admin.product.imageDestroy', $image->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Устгах</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Энэхүү бүтээгдэхүүний хувьд зургууд байхгүй.</p>
            @endif
        </div>

    </div>
@endsection
