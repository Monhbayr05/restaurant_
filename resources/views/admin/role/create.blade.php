@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center p-2">
            <h6 class="m-2 font-weight-bold text-primary d-inline fs-5">Бүтээгдэхүүн Нэмэх</h6>
            <a href="{{ route('role.index') }}" class="btn btn-primary float-end">Буцах</a>
        </div>

        <div class="card-body">
            <form action="{{ route('role.store') }}" method="POST" enctype="multipart/form-data">
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
                <div class="tab-content" id="productTabContent">
                    <!-- Home Tab -->
                    <div class="tab-pane fade border p-3 show active" id="home-tab-pane" role="tabpanel"
                         aria-labelledby="home-tab">
                        <div class="mb-3">
                            <label for="name" class="form-label">Нэр</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">И-мэйл</label>
                            <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Нууц үг</label>
                            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Нууц үгээ давтан оруулна уу</label>
                            <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
                        </div>
                        <div class="mb-3">
                            <label for="restaurant_id" class="form-label">Ресторан</label>
                            <select name="restaurant_id" class="form-control" required>
                                <option value="">Ресторан сонгох</option>
                                @foreach ($restaurants as $restaurant)
                                    <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="role_id" class="form-label">Албан тушаал</label>
                            <select name="role_id" class="form-control" required>
                                <option value="">Албан тушаал сонгох</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary float-end">Илгээх</button>
                </div>
            </form>


        </div>
    </div>

@endsection
