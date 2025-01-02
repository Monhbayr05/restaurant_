@extends('layouts.admin')
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Ширээ </h3>
                <p class="text-subtitle text-muted">hdhjkfhdjkfhdjk</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Ширээ Жагсаалт</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ширээ Жагсаалт</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="card shadow mb-4" style="width: 70%;">
                    <div class="card-header text-center">
                        <h3 class="card-title">Ширээ Нэмэх Форум</h3>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('admin.table.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label>Ресторан сонгох</label>
                                    <select name="restaurant_id" class="form-select" aria-label="Default select example">
                                        <option>Ресторан сонго</option>
                                        @foreach($restaurants as $restaurant)
                                        <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('restaurant_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Ширээ нэр</label>
                                    <input type="text" name="name" class="form-control" placeholder="Ширээ нэр" value="{{ old('name') }}">
                                    @error('name')
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
    </section>
    <section class="section">
        <div class="card shadow mb-4">
            <div class="card-header p-3 align-items-center">
                <h3 class="m-3 font-weight-bold text-primary">Ширээ Жагсаалт</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive ">
                    <table class="table table-bordered text-algin-center align-items-center" id="table1">
                        <thead class="pt-4">
                            <tr>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">ID</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Нэр</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Салбарын нэр</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Үүсгэсэн огноо</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Үйлдлүүд</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tables as $table)
                            <tr>
                                <td>{{ $table->id }}</td>
                                <td>{{ $table->name }}</td>
                                <td>{{ $table->restaurant->name }}</td>
                                <td>{{ $table->created_at }}</td>
                                <td class="Action">

                                    <div class="dropdown dropstart">
                                        <button class="btn btn-white dropdown-toggle border-primary border-2 text-primary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Үйлдэл
                                        </button>

                                        <ul class="dropdown-menu dropdown-menu-left list-inline">
                                            <li class="d-flex align-items-center text-left me-3">
                                                <button type="button" class="dropdown-item text-primary p-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $table->id }}">
                                                    <i class="fas fa-edit mr-2"></i>Өөрчлөх
                                                </button>
                                            </li>
                                            <li class="d-flex align-items-center text-left me-3">
                                                <form id="delete-form-{{ $table->id }}" action="{{ route('admin.table.delete', $table->id) }}" method="POST" style="display: inline-block; width:100%;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button id="delete-button" type="submit" class="text-danger dropdown-item delete-button p-2" data-id="{{ $table->id }}">
                                                        <i class="fas fa-trash-alt mr-2"></i>Устгах
                                                    </button>
                                                </form>
                                            </li>
                                            <li class="d-flex align-items-center text-left me-3">
                                                <button type="button" class="dropdown-item text-black p-2" data-bs-toggle="modal" data-bs-target="#QrModal{{ $table->id }}">
                                                    <i class="fas fa-qrcode mr-2"></i> QR
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Edit Button -->


                                    <!-- QR Code Modal -->
                                    <div class="modal fade" id="QrModal{{ $table->id }}" tabindex="-1" aria-labelledby="QrModalLabel{{ $table->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="QrModalLabel{{ $table->id }}">QR Код</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <!-- Display the QR Code Image -->
                                                    <div class="qr-code-image">
                                                        {!! $table->qr_image !!} <!-- Assuming $table->qr_image contains the QR code image HTML -->
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Хаах</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal{{ $table->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $table->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $table->id }}">Ресторан засах</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.table.update', encrypt($table->id)) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label>Ширээний Нэр</label>
                                                            <input type="text" name="name" class="form-control" value="{{ $table->name }}">
                                                            @error('name')
                                                            <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label>Ресторан сонгох</label>
                                                            <select name="restaurant_id" class="form-select">
                                                                <option value="">Ресторан сонго</option>
                                                                @foreach($restaurants as $restaurant)
                                                                <option value="{{ $restaurant->id }}" {{ old('restaurant_id') == $restaurant->id ? 'selected' : '' }}>
                                                                    {{ $restaurant->name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                            @error('restaurant_id')
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