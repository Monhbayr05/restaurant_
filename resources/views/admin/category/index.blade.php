@extends('layouts.admin')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Ангилал </h3>
                <p class="text-subtitle text-muted">hdhjkfhdjkfhdjk</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Ангилал Жагсаалт</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ангилал Жагсаалт</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="card shadow mb-4" style="width: 70%;">
                    <div class="card-header text-center">
                        <h3 class="card-title">Ангилал Нэмэх Форум</h3>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label>Ресторан сонгох</label>
                                    <select name="restaurant_id" class="form-select" aria-label="Default select example">
                                        <option>Ресторан сонго</option>
                                        @foreach($restaurants as $restaurant)
                                        <option value="{{ $restaurant->id }}">
                                            {{ $restaurant->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('restaurant_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Ангилал нэр</label>
                                    <input type="text" name="name" class="form-control" placeholder="Ангилал нэр" value="{{ old('name') }}" />
                                    @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Зураг</label>
                                    <input type="file" name="thumbnail" class="form-control" />
                                    @error('thumbnail')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-2 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary mx-2">
                                        Хадгалах
                                    </button>
                                    <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </section> -->



    <section id="content-types">
        <h3 class="m-3 font-weight-bold text-primary">Ангилал Карт</h3>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($categories as $item)
                <div class="swiper-slide">
                    <div class="card h-100">
                        <div class="card-content">
                            <img
                                class="card-img-top img-fluid border-radius-lg object-cover"
                                src="{{ $item->thumbnail ? asset($item->thumbnail) : asset('images/placeholder.jpg') }}"
                                alt="{{ $item->name }}"
                                style="height: 200px; object-fit: cover;"
                                loading="lazy" />
                            <div class="card-body">
                                <h4 class="card-title text-primary text-truncate">{{ $item->name }}</h4>
                                <p class="card-text text-muted text-truncate">
                                    {{ $item->restaurant->name }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- Stylish Swiper Buttons -->
            <div class="swiper-button-next rounded-circle text-white bg-primary shadow page-link"></div>
            <div class="swiper-button-prev rounded-circle text-white bg-primary shadow page-link"></div>
        </div>
    </section>



    <section class="section">
        <div class="card shadow mb-4">
            <div class="card-header p-3 d-flex align-items-center justify-content-between">
                <h3 class="m-3 font-weight-bold text-primary">Ангилал Хүснэгт</h3>
                <div class="flex-end">
                    <div class="create-page">
                        <!-- Button trigger modal -->
                        <button type="button"
                            class="btn btn-outline-primary fs-4"
                            data-bs-toggle="modal"
                            data-bs-target="#inlineForm">
                            +&nbsp; Ангилал нэмэх
                        </button>

                        <!-- modal  -->
                        <div
                            class="modal fade text-left"
                            id="inlineForm"
                            tabindex="-1"
                            role="dialog"
                            aria-labelledby="myModalLabel33"
                            aria-hidden="true">
                            <div
                                class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title d-flex justify-content-center fs-3" id="myModalLabel33">Ангилал Нэмэх Форум</h4>
                                        <button
                                            type="button"
                                            class="close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card shadow-none" style="width: 100%">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <form
                                                        action="{{ route('admin.category.store') }}"
                                                        method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label>Ресторан сонгох</label>
                                                            <select
                                                                name="restaurant_id"
                                                                class="form-select"
                                                                aria-label="Default select example">
                                                                <option>Ресторан сонго</option>
                                                                @foreach($restaurants as $restaurant)
                                                                <option value="{{ $restaurant->id }}">
                                                                    {{ $restaurant->name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                            @error('restaurant_id')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Ангилал нэр</label>
                                                            <input
                                                                type="text"
                                                                name="name"
                                                                class="form-control"
                                                                placeholder="Ангилал нэр"
                                                                value="{{ old('name') }}" />
                                                            @error('name')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Зураг</label>
                                                            <input type="file" name="thumbnail" class="form-control" />
                                                            @error('thumbnail')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mt-3 d-flex justify-content-center">
                                                            <button type="submit" class="btn btn-primary mx-2">
                                                                Хадгалах
                                                            </button>
                                                            <button
                                                                type="button"
                                                                class="btn btn-secondary mx-2"
                                                                data-bs-dismiss="modal">
                                                                Close
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal duusah  -->
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive ">
                    <table class="table table-bordered text-algin-center align-items-center" id="table1">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Нэр</th>
                                <th>Салбарын нэр</th>
                                <th>Зураг</th>
                                <th>Үүсгэсэн огноо</th>
                                <th>Үйлдлүүд</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <img src="{{ asset($item->thumbnail) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1" width="150px" height="150px">
                                </td>
                                <td>
                                    @if($item->restaurant)
                                    {{ $item->restaurant->name }}
                                    @else
                                    Restaurant not found
                                    @endif
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td class="editDelete justify-content-right">
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Үйлдэл
                                        </button>
                                        <ul class="dropdown-menu shadow-lg">
                                            <!-- Edit Option -->
                                            <li>
                                                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                                    <i class="fas fa-edit me-2"></i>Өөрчлөх
                                                </button>
                                            </li>
                                            <!-- Delete Option -->
                                            <li>
                                                <form id="delete-form-{{ $item->id }}" action="{{ route('admin.category.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button id="delete-button" type="submit" class="dropdown-item text-danger delete-button">
                                                        <i class="fas fa-trash-alt me-2"></i>Устгах
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>



                                    <!-- Edit Modal -->
                                    <div class="modal fade text-left" id="editModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="editModalLabel{{ $item->id }}"></h4>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <i data-feather="x"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card-head">
                                                                        <h4 class="font-weight-light">Ангилал засах:</h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card-body">
                                                                        <form action="{{ route('admin.category.update', encrypt($item->id)) }}" method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="mb-3">
                                                                                <label>Ресторан сонгох</label>
                                                                                <select name="restaurant_id" class="form-select" aria-label="Default select example">
                                                                                    <option value="">Ресторан сонго</option>
                                                                                    @foreach($restaurants as $restaurant)
                                                                                    <option value="{{ $restaurant->id }}" {{ old('restaurant_id', $item->restaurant_id) == $restaurant->id ? 'selected' : '' }}>
                                                                                        {{ $restaurant->name }}
                                                                                    </option>
                                                                                    @endforeach
                                                                                </select>
                                                                                @error('restaurant_id')
                                                                                <small class="text-danger">{{ $message }}</small>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label>Ангилал нэр</label>
                                                                                <input type="text" name="name" class="form-control" placeholder="Ангилал нэр" value="{{ old('name', $item->name) }}">
                                                                                @error('name')
                                                                                <small class="text-danger">{{ $message }}</small>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label>Зураг</label>
                                                                                <input type="file" name="thumbnail" class="form-control">
                                                                                @error('thumbnail')
                                                                                <small class="text-danger">{{ $message }}</small>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary">Хадгалах</button>
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

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


</div>

@endsection






@section('alert')
@if (Session::has('success'))
<script>
    Swal.fire({
        title: " Амжилттай!",
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