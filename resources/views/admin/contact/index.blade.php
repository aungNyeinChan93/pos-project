@extends("admin.layouts.master")

@section("content")

<div class="container-fluid">
    <div class="row">
        <div class="col my-2 ">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="text-primary text-center">Contact Infromation </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">

            @foreach ($contacts as $contact)
                <div class="card my-2">
                    <div class="card-header">
                        {{$contact->title }}
                    </div>
                    <div class="card-body">
                    <h5 class="card-title">{{ $contact->user->name }}</h5>
                    <h5 class="card-text text-danger ">{{ $contact->created_at->diffForHumans()}}</h5>
                    <p class="card-text">{{ $contact->message }}</p>
                    <form action="{{ route("adminContact#delete",$contact->id) }}" method="POST">
                        @csrf
                        @method("delete")
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    </div>
                </div>
            @endforeach

            {{ $contacts->links() }}
        </div>
    </div>
</div>

@endsection
