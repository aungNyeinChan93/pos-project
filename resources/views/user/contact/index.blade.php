@extends('user.layouts.master')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="p-5"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card mt-3 ">
                    <div class="card-header">
                        <h3 class="text-danger my-2">Contact Form <span class="text-muted text-primary">({{ Auth::user()->name }})</span></h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route("contact#create") }}" class="form-control p-4" method="POST">
                            @csrf

                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                            <input type="text" name="title" placeholder="Title ..."
                                class="form-control my-2 @error('title')
                            is-invalid
                            @enderror"
                                value="{{ old('title') }}">
                            @error('title')
                                <span class="text-secondary d-block p-2"> {{ $message }}</span>
                            @enderror

                            <textarea placeholder="Enter message.." name="message" id="" cols="30" rows="10" class="form-control @error("message")
                                is-invalid
                            @enderror">{{ old("message") }}</textarea>
                            @error('message')
                                <span class="text-secondary d-block p-2"> {{ $message }}</span>
                            @enderror

                            <input type="submit" value="Submit" class="btn btn-primary my-2">
                            <a href="{{ route("userHome") }}" class="btn btn-secondary ">Back</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
