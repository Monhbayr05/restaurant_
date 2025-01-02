@extends('layouts.chef')
@section('chef')
    <!-- <div class="container mx-auto">
        <livewire:chef-dashboard :restaurant-id="auth()->user()->restaurant_id" />

    </div> -->
    <section class="section">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary d-inline fs-5">Ангилал Жагсаалт</h6>
                <div class="float-end">
                    <div class="create-page">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary p-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            +&nbsp; Ангилал нэмэх
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ангилал үүсгэх</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card-head">
                                                            <h4 class="font-weight-light">Ангилал оруулах:</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card-body">
                                                            <!-- <form action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data">
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
                                                                    <label>Ангилал нэр</label>
                                                                    <input type="text" name="name" class="form-control" placeholder="Ангилал нэр" value="{{old('name')}}">
                                                                    @error('name')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>Зураг</label>
                                                                    <input type="file" name="thumbnail" class="form-control"/>
                                                                    @error('thumbnail')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-2">
                                                                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </form> -->
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
                <div class="table-responsive ">
                    <table class="table table-bordered align-items-center" id="table1">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">ID</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Нэр</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Салбарын нэр</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Зураг</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Үүсгэсэн огноо</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Үйлдлүүд</th>
                            </tr>
                        </thead>
                        
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

