    @extends("admin.layouts.master")

@section("content")

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="parent d-flex justify-content-end">
                    <form action="{{ route("userList#index") }}" method="get">
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
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    @if($user->name == null)
                                        {{ $user->nickName }}
                                    @endif
                                    @if($user->name !== null)
                                        {{ $user->name }}
                                    @endif
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->address }}</td>
                                <td><span class="text-danger">{{ $user->role }}</span></td>
                                <td>
                                    @if($user->provider == "")
                                        <small class="text-info"> sample login </small>
                                    @endif
                                    @if($user->provider == "google")
                                        <small class="text-info"> Google</small>
                                    @endif
                                    @if($user->provider == "github")
                                        <small class="text-info"> Github</small>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format("d-m-Y") }}</td>
                                <td>
                                    @if(Auth::user()->id !== $user->id)
                                        <a href="{{ route("adminList#delete",$user->id) }}" class="btn btn-sm btn-danger w-100">Delete</a>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links('pagination::bootstrap-5') }}

                <a href="{{ route("adminHome") }}" class="btn btn-outline-primary"> Back</a>
            </div>
        </div>
    </div>

@endsection
