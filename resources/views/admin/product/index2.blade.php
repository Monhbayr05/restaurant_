@extends('layouts.admin')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Бүтээгдэхүүн</h3>
                <p class="text-subtitle text-muted">hdhjkfhdjkfhdjk</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Бүтээгдэхүүн Жагсаалт</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Бүтээгдэхүүн Жагсаалт</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section id="content-types">
        <div class="row">
            @foreach ($products as $item)
            <div class="col-xl-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-content">
                        <img
                            class="card-img-top img-fluid border-radius-lg object-cover"
                            src="{{ $item->thumbnail ? asset($item->thumbnail) : asset('images/placeholder.jpg') }}" 
                            alt="{{ $item->name }}"
                            style="height: 200px; object-fit: cover;"
                            loading="lazy" />

                        <div class="card-body">
                            <h4 class="card-title text-primary">{{ $item->name }}</h4>
                            <p class="card-text text-muted">
                                {{ $item->description }}
                            </p>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <span class="text-muted">Үнэ</span>
                        <h3 class="btn btn-light-primary">{{ number_format($item->price) }}₮</h3>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>
@endsection

@section('alert')
@if (Session::has('success'))
<script>
    Swal.fire({
        title: "Амжилттай!",
        text: "{{ Session::get('success') }}",
        icon: "success"
    });
</script>
@endif

@if (Session::has('error'))
<script>
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "{{ Session::get('error') }}!",
    });
</script>
@endif
@endsection
