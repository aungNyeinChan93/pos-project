@extends('admin.layouts.master')

@section("content")

<div class="container">

    <div class="row">
        <div class="col-12">
            @if(session("comment-del"))
            <div class="alert alert-danger">
                <span>{{ session("comment-del") }}</span>
            </div>
            @endif
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-primary text-center p-1">User Comments</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class=" bg-primary text-white">
                            <tr>
                                <td>User Name</td>
                                <td>Product Name</td>
                                <td>Comment</td>
                                <td>Date</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $comment)
                                <tr>
                                    <td>{{ $comment->user->name }}</td>
                                    <td>{{ $comment->product->name }}</td>
                                    <td>{{ Str::limit($comment->comment,40," more...") }}</td>
                                    <td>{{ $comment->created_at->format("j-F-Y h-m A") }}</td>
                                    <td>
                                        <div class=" d-flex justify-content-around">
                                        <form action="{{ route("adminComment#detail",$comment->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-info"><i class="fa-solid fa-bars"></i></button>
                                        </form>
                                        <form action="{{route("adminComment#delete",$comment->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $comments->links() }}

                </div>
            </div>
            <a href="{{ route("adminHome") }}" class="btn btn-outline-primary my-2">Back</a>
        </div>
    </div>
</div>

@endsection
