@extends('admin.layouts.master')

@section('content')
    <div class="container-sm ">
        <div class="col-8 offset-2 my-5">
            <div class="card ">
                <div class="card-header">
                    <h4 class="text-center mt-2 ">Create Admin Account</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route("profile#adminAccCreateAction") }}" method="POST">
                        @csrf
                        <div class="px-5 py-2">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control
                                @error('name')
                                    is-invalid
                                @enderror"
                                id="name" name="name"
                                value="{{ old("name") }}">
                                @error("name")
                                    <div class="alert alert-warning mt-2">
                                        <small class="text-danger">{{ $message }}</small>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email"
                                class="form-control
                                @error('email')
                                    is-invalid
                                @enderror"
                                id="email" name="email"
                                value="{{ old("email") }}">
                                @error("email")
                                    <div class="alert alert-warning mt-2">
                                        <small class="text-danger">{{ $message }}</small>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="text"
                                class="form-control
                                @error('password')
                                    is-invalid
                                @enderror"
                                id="password" name="password">
                                @error("password")
                                    <div class="alert alert-warning mt-2">
                                        <small class="text-danger">{{ $message }}</small>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="text"
                                class="form-control
                                @error('password_confirmation')
                                    is-invalid
                                @enderror"
                                id="password_confirmation"
                                    name="password_confirmation">
                                    @error("password_confirmation")
                                    <div class="alert alert-warning mt-2">
                                        <small class="text-danger">{{ $message }}</small>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input type="submit" value="Create" class="btn btn-sm btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
