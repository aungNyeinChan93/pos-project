@extends('user.layouts.master')


@section('content')
    {{-- form start --}}
    <div class="container ">
        <h4 class="text-center my-3 p-4">Password Change</h4>
        <div class="row">
            <div class="col-8 offset-2 my-2">

                <div class="p-4">
                    @if ($errors->any())
                    <ol>
                        @foreach ($errors->all() as $error)
                            <li class="alert alert-danger ">{{ $error }}</li>
                        @endforeach
                    </ol>
                @endif
                </div>

                <form method="POST" action="{{ route('profile#passwordUpdate') }}" class=" shadow-sm rounded-5 p-3">
                    @csrf
                    @method('put')
                    <div class="mb-3 ">
                        <input type="password"
                            class="form-control @error('currentPassword')
                            is-invalid
                        @enderror"
                            placeholder="Current password" name="currentPassword">
                    </div>

                    <div class="mb-3 ">
                        <input type="password"
                            class="form-control @error('password')
                            is-invalid
                        @enderror"
                            placeholder="New password" name="password">
                    </div>

                    <div class="mb-3 ">
                        <input type="password"
                            class="form-control @error('password_confirmation')
                            is-invalid
                        @enderror"
                            placeholder="Confirm password" name="password_confirmation">
                    </div>



                    <input type="submit" value="change" class="btn btn-sm btn-primary ">

                    <a href="{{ route("profile#showpage") }}" class="btn btn-sm btn-dark">Back</a>
                </form>
            </div>
        </div>
    </div>
    {{-- form end --}}

@endsection
