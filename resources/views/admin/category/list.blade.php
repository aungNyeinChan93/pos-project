@extends('admin.layouts.master')


@section('content')

    {{-- form start --}}
    <div class="container ">
        <h4 class="text-center p-3">Categories</h4>
        <div class="row">
            <div class="col-10 offset-1 my-2">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
                <form action="{{ route('category#create') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text"
                            class="form-control
                                    @error('name')
                                    is-invalid
                                    @enderror"
                            placeholder="Category Name" name="name">
                        <button class="btn btn-outline-primary ms-2" type="submit">Create</button>
                    </div>
                </form>
            </div>
            <div class="col-10 offset-1">
                <table class="table table table-hover rounded shadow-sm ">
                    <thead class="bg-primary text-white ">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($categories) == 0)
                            <tr>
                                <td colspan="4" class="text-center"><span class="text-muted ">Empty Data...</span></td>
                            </tr>
                        @endif
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('category#edit', $category->id) }}"
                                        class=" mx-1 btn btn-sm btn-success">Edit </a>
                                    <form class=" d-inline" action="{{ route('category#delete', $category->id) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <button class=" mx-1 btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $categories->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>

    </div>
    {{-- form end --}}

@endsection
