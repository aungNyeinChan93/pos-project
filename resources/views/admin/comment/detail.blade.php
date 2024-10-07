@extends('admin.layouts.master')

@section('content')

<div class="conatiner">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    {{$comment->user->name }} comment
                </div>
                <div class="card-body">
                    <h4>{{ $comment->product->name }}</h4>
                    <p class="text-muted">
                    {{ $comment->comment }}
                    </p>
                </div>
                <div class="card-footer">
                    <a class="btn btn-sm btn-secondary" href="{{ route("adminComment#index") }}">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
