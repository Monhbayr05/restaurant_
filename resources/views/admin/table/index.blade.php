@extends('layouts.admin')
@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Ресторан Оруулах</h6>
                        <div class="float-end">
                            <div class="create-page">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                    Ресторан үүсгэх
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="card-head">
                                                                    <h4 class="font-weight-light">
                                                                        Ширээ оруулах:
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="card-body">
                                                                    <form action="{{route('admin.table.store')}}"
                                                                          method="POST"
                                                                          enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="mb-3">
                                                                            <label>Ресторан сонгох</label>
                                                                            <input type="text"
                                                                                   name="name"
                                                                                   class="form-control"
                                                                                   placeholder="Ресторан сонгох"
                                                                                   value="{{old('name')}}">
                                                                            @error('name')
                                                                            <small
                                                                                class="text-danger">{{$message}}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label>Ширээ нэр</label>
                                                                            <input type="text"
                                                                                   name="table-name"
                                                                                   class="form-control"
                                                                                   placeholder="Ширээ нэр"
                                                                                   value="{{old('table-name')}}">
                                                                            @error('table-name')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="mb-2">
                                                                            <button type="submit"
                                                                                    class="btn btn-primary">
                                                                                Хадгалах
                                                                            </button>
                                                                            <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Close
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>2011-04-25</td>
                                    <td>$320,800</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('dataTable-script')
    <script src="{{ asset('admin/assets/js/datatable/datatable_bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/datatable/datatable_jquery.js') }}"></script>
    <script src="{{ asset('admin/assets/js/datatable/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('admin/assets/js/datatable/dataTables.js') }}"></script>
@endsection
@section('datatable-css')
    <link href="">
@endsection
