@extends('admin.layouts.master')


@section('content')
    {{-- form start --}}
    <div class="container ">
        <h4 class="text-center my-3 p-4">Category Update</h4>
        <div class="row">
            <div class="col-10 offset-1 my-2">

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif

                <form action="{{ route('category#update', $category->id) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text"
                            class="form-control
                                @error('name')
                                is-invalid
                                @enderror"
                            placeholder="Category Name" name="name" value="{{ $category->name }}">
                        <button class="btn btn-outline-primary ms-2" type="submit">Update</button>
                    </div>
                </form>
                <a href="{{ route('category#list') }}" class="btn btn-outline-primary ms-2" type="submit">Back</a>
            </div>
        </div>
    </div>
    {{-- form end --}}

@endsection
