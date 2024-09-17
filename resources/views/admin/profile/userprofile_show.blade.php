@extends('admin.layouts.master')


@section('content')
    <div class="container-sm ">
        <div class="p-4">
            <div class="card shadow-sm rounded-4">
                <div class="card-header">
                    <h4 class="text-center fst-italic pt-1">User Profile</h4>
                </div>
                <div class="card-body my-4">
                    <div class="row">
                        <div class="col-3 offset-1 ">
                            <img src="{{ asset(Auth::user()->profile_image == null ? 'admin/img/undraw_posting_photo.svg' : '/profile/'.Auth::user()->profile_image) }}"
                                class="img-thumbnail my-4">
                        </div>
                        <div class="col offset-1">
                            <div class="row my-3">
                                <div class="col-4 "> <strong>Name</strong></div>
                                <div class="col">
                                    {{ Auth::user()->name == null ? Auth::user()->nickName : Auth::user()->name }}</div>
                            </div>

                            <div class="row my-3">
                                <div class="col-4 "> <strong>Email</strong></div>
                                <div class="col">{{ Auth::user()->email }}</div>
                            </div>

                            <div class="row my-3">
                                <div class="col-4 "> <strong>Phone Number</strong></div>
                                <div class="col">{{ Auth::user()->phone }}</div>
                            </div>

                            <div class="row my-3">
                                <div class="col-4 "> <strong>Role</strong></div>
                                <div class="col text-danger ">{{ Auth::user()->role }}</div>
                            </div>

                            <a href="{{ route('password#show') }}" class="btn btn-sm btn-warning my-3 mr-1">Change
                                Password</a>
                            <a href="{{ route('profile#edit') }}" class="btn btn-sm btn-danger my-3 mr-1">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
