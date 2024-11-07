@extends('layouts.admin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary d-inline fs-5">Ширээ Жагсаалт</h6>
        <div class="float-end">
            <button type="button" class="btn btn-primary p-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                +&nbsp; Ширээ Нэмэх
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fs-5" id="exampleModalLabel">Ширээ оруулах</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-2">
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
    <div class="card-body">
        <div class="table responsive">
            <table id="dataTable" class="table table-bordered text-center align-items-center" style="width:100%">
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
                            <td >{{ $table->id }}</td>
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
@endsection


@section('dataTable-script')
<script src="{{ asset('admin/assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/demo/datatables-demo.js') }}"></script>
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



@if (Session::has('delete'))
    <script>
        function delay(seconds) {
            return new Promise(resolve => setTimeout(resolve, seconds * 1000));
        }

        document.getElementById('delete-button').addEventListener('click', async function(event) {


            const result = await Swal.fire({
                title: "Та итгэлтэй байна уу?",
                text: "Та үүнийг буцааж авах боломжгүй болно!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Тийм, устгах!"
            });

            if (result.isConfirmed) {
                await delay(1.5); 
                document.getElementById('delete-form').submit();
            }
        });


        @if(session('delete'))
            (async () => {
                await delay(0.5);
                Swal.fire({
                    title: "Устгасан!",
                    text: "{{ session('delete') }}",
                    icon: "success",
                    confirmButtonText: "Ойлголоо"
                });
            })();
        @endif
    </script>
@endif
@endsection