@extends('layouts.manager')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last mb-3">
                    <h3>Хэрэглэгч нэмэх </h3>
                    <p class="text-subtitle text-muted">
                        Complete the form with powerful validation library such as Parsley.
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav
                        aria-label="breadcrumb"
                        class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('manager.dashboard')}}">Хяналтын цэс</a></li>
                            <li class="breadcrumb-item" aria-current="page">
                                <a href="{{ route('manager.role.index') }}">Хэрэглэгчийн бүртгэл</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="">Хэрэглэгч нэмэх</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center p-3">
                            <h4 class="card-title">Хэрэглэгч Нэмэх Форум</h4>
                            <a href="{{ route('manager.role.index') }}" class="btn btn-primary float-end">Буцах</a>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form action="{{ route('manager.role.store') }}" method="POST" enctype="multipart/form-data" class="form">
                                    @csrf
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label for="name" class="form-label">Нэр</label>
                                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label for="email" class="form-label">И-мэйл</label>
                                                <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label for="password" class="form-label">Нууц үг</label>
                                                <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label for="role_id" class="form-label">Албан тушаал</label>
                                                <select name="role_id" class="form-control" required>
                                                    <option value="">Албан тушаал сонгох</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mandatory">
                                                <label for="password_confirmation" class="form-label">Нууц үгээ давтан оруулна уу</label>
                                                <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" placeholder="Нууц үгээ давтан оруулна уу." required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">
                                                Илгээх
                                            </button>
                                            <button
                                                type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">
                                                Шинэчлэх
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
