@extends("admin.layouts.master")

@section("content")

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="parent d-flex justify-content-end">
                    <form action="{{ route("adminList#index") }}" method="get">
                        <div class="input-group mb-3">
                            <input type="text" name="searchKey" class="form-control" placeholder="Search..." >
                            <button type="submit" class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12">
                <table class="table table-bordered table-hover p-2 shadow-sm rounded my-3 ">
                    <thead class="bg-primary text-white">
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Phone</td>
                            <td>Address</td>
                            <td>Role</td>
                            <td>Provider</td>
                            <td>Create Date</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                            <tr>
                                <td>{{ $admin->id }}</td>
                                <td>
                                    @if($admin->name == null)
                                        {{ $admin->nickName }}
                                    @endif
                                    @if($admin->name !== null)
                                        {{ $admin->name }}
                                    @endif
                                </td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->phone }}</td>
                                <td>{{ $admin->address }}</td>
                                <td><span class="text-danger">{{ $admin->role }}</span></td>
                                <td>
                                    @if($admin->provider == "")
                                        <small class="text-danger"> sample login </small>
                                    @endif
                                    @if($admin->provider == "google")
                                        <small class="text-danger"> Google</small>
                                    @endif
                                    @if($admin->provider == "github")
                                        <small class="text-danger"> Github</small>
                                    @endif
                                </td>
                                <td>{{ $admin->created_at->format("d-m-Y") }}</td>
                                <td>
                                    @if($admin->role !== "superAdmin" && Auth::user()->id !== $admin->id)
                                        <a href="{{ route("adminList#delete",$admin->id) }}" class="btn btn-sm btn-danger w-100">Delete </a>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $admins->links('pagination::bootstrap-5') }}

            </div>
        </div>
    </div>

@endsection
