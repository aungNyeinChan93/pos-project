@extends('user.layouts.master')


@section('content')
    <div class="row p-5"></div>
    <div class="container-sm ">
        <div class="p-4">
            <div class="card shadow-sm rounded-4">
                <div class="card-header">
                    <h4 class="text-center p-2">{{ Auth::user()->name }} <small class="text-danger fs-"><em>{{ Auth::user()->role }}</em></small></h4>
                </div>
                <div class="card-body">
                    <form action="{{ route("profile#updateUser") }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method("put")
                        <div class="row">
                            <div class="col-lg-4">

                                <img src="{{ asset(Auth::user()->profile_image == null ? "admin/img/undraw_posting_photo.svg":"/profile/".Auth::user()->profile_image) }}" alt="test"
                                id="output"
                                class=" img-profile w-100 my-2 p-2 rounded-3 shadow"
                                >

                                <input type="file" name="image" class="form-input mt-3
                                @error("image")
                                    is-invalid
                                @enderror"
                                onchange="loadFile(event)"
                                >
                                @error("image")
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col">
                                <div class="row my-1">
                                    <div class="col-6">
                                        <input type="text" name="name"  class="form-control my-2
                                        @error("name")
                                            is-invalid
                                        @enderror"
                                        placeholder="Name ..."
                                        value="{{ old("name",Auth::user()->name != null ? Auth::user()->name : Auth::user()->nickName) }}"
                                        >
                                        @error("name")
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                <div class="col-6">
                                    <input type="text" name="email"  class="form-control my-2
                                        @error("email")
                                            is-invalid
                                        @enderror"
                                        placeholder="Email ..."
                                        value="{{ old("email",Auth::user()->email) }}"
                                        >
                                        @error("email")
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                </div>
                                </div>

                                <div class="row my-1">
                                    <div class="col-6">
                                        <input type="text" name="phone"  class="form-control my-2
                                         @error("phone")
                                             is-invalid
                                        @enderror" placeholder="09..."
                                        value="{{ old("phone",Auth::user()->phone) }}"
                                        >
                                        @error("phone")
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="address"  class="form-control my-2
                                        @error("address")
                                            is-invalid
                                        @enderror" placeholder="Address ..."
                                        value="{{ old("address",Auth::user()->address) }}">
                                        @error("address")
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <input type="submit" value="Submit" class="btn btn-sm btn-outline-primary my-2">
                                <a href="{{ route("profile#showpage") }}" class="btn btn-secondary btn-sm ">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
