@extends('layouts.admin')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Ресторан </h3>
                <p class="text-subtitle text-muted">hdhjkfhdjkfhdjk</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Ресторан Жагсаалт</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ресторан Жагсаалт</li>
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
                        <h3 class="card-title">Ресторан Нэмэх Форум</h3>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('admin.restaurant.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label>Ресторан Нэр</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
                                    @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Товчлол</label>
                                    <input type="text" name="slug" class="form-control" placeholder="Товчлол" value="{{ old('slug') }}">
                                    @error('slug')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Байршил</label>
                                    <input type="text" name="location" class="form-control" placeholder="Байршил" value="{{ old('location') }}">
                                    @error('location')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Утасны дугаар</label>
                                    <input type="text" name="phone_number" class="form-control" placeholder="Утасны дугаар" value="{{ old('phone_number') }}">
                                    @error('phone_number')
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
    <section class="section">
        <div class="card shadow mb-4">
            <div class="card-header p-3 d-flex align-items-center justify-content-between">
                <h3 class="m-3 font-weight-bold text-primary">Ресторан Жагсаалт</h3>
                <div class="flex-end">
                    <div class="create-page">
                        <!-- Button trigger modal -->
                        <button type="button"
                            class="btn btn-outline-primary fs-5"
                            data-bs-toggle="modal"
                            data-bs-target="#inlineForm">
                            +&nbsp; Ресторан нэмэх
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
                                        <h4 class="modal-title d-flex justify-content-center fs-3" id="myModalLabel33">Ресторан Нэмэх Форум</h4>
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
                                                    <form action="{{ route('admin.restaurant.store') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label>Ресторан Нэр</label>
                                                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
                                                            @error('name')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Товчлол</label>
                                                            <input type="text" name="slug" class="form-control" placeholder="Товчлол" value="{{ old('slug') }}">
                                                            @error('slug')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Байршил</label>
                                                            <input type="text" name="location" class="form-control" placeholder="Байршил" value="{{ old('location') }}">
                                                            @error('location')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Утасны дугаар</label>
                                                            <input type="text" name="phone_number" class="form-control" placeholder="Утасны дугаар" value="{{ old('phone_number') }}">
                                                            @error('phone_number')
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
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">ID</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Нэр</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Товчлол</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Байршил</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Утасны дугаар</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Үүсгэсэн огноо</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Үйлдлүүд</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($restaurants as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->slug }}</td>
                                <td>{{ $item->location }}</td>
                                <td>{{ $item->phone_number }}</td>
                                <td>{{ date('d-m-y', strtotime($item->created_at)) }}</td>
                                <td class="editDelete justify-content-center">
                                    <!-- Edit Button -->
                                    <div class="dropdown dropstart">
                                        <button class="btn btn-white dropdown-toggle border-primary text-primary border-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Үйлдэл
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-black">
                                            <li class="d-flex align-items-center text-left me-3">
                                                <button type="button" class="dropdown-item btn-primary p-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                                    <i class="fas fa-edit mr-2"></i>Өөрчлөх
                                                </button>
                                            </li>
                                            <li class="d-flex align-items-center text-left me-3">
                                                <form action="{{ route('admin.restaurant.delete', $item->id) }}" method="POST" style="display: inline-block; width:100%;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button id="delete-button" type="submit" class="dropdown-item text-danger p-2">
                                                        <i class="fas fa-trash-alt mr-2"></i>Устгах
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="editModalLabel{{ $item->id }}">Ресторан засах</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.restaurant.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="p-3">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label>Ресторан Нэр</label>
                                                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name', $item->name) }}">
                                                            @error('name')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Товчлол</label>
                                                            <input type="text" name="slug" class="form-control" placeholder="Товчлол" value="{{ old('slug', $item->slug) }}">
                                                            @error('slug')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Байршил</label>
                                                            <input type="text" name="location" class="form-control" placeholder="Байршил" value="{{ old('location', $item->location) }}">
                                                            @error('location')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Утасны дугаар</label>
                                                            <input type="text" name="phone_number" class="form-control" placeholder="Утасны дугаар" value="{{ old('phone_number', $item->phone_number) }}">
                                                            @error('phone_number')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-2 mt-4">
                                                            <button type="submit" class="btn btn-primary">Хадгалах</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
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