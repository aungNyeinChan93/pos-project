@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-4 mt-3">

                <div class="card my-5">
                    <div class="card-header">
                        <h5 class="text-center mt-2"> Payment </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('payment#create') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="accName" class="form-label">Account Name</label>
                                <input type="text"
                                    class="form-control
                                @error('accName')
                                    is-invalid
                                @enderror"
                                    id="accName" name="accName" value="{{ old('accName') }}">
                                @error('accName')
                                    <div class="alert alert-warning mt-2">
                                        <small class="text-danger">{{ $message }}</small>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="accNumber" class="form-label">Account Number</label>
                                <input type="number"
                                    class="form-control
                                @error('accNumber')
                                    is-invalid
                                @enderror"
                                    id="accNumber" name="accNumber" value="{{ old('accNumber') }}">
                                @error('accNumber')
                                    <div class="alert alert-warning mt-2">
                                        <small class="text-danger">{{ $message }}</small>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="accType" class="form-label">Account Type</label>
                                <input type="text"
                                    class="form-control
                                @error('accType')
                                    is-invalid
                                @enderror"
                                    id="accType" name="accType" value="{{ old('accType') }}">
                                @error('accType')
                                    <div class="alert alert-warning mt-2">
                                        <small class="text-danger">{{ $message }}</small>
                                    </div>
                                @enderror
                            </div>

                            <input type="submit" value="Create" class="btn btn-sm btn-info my-2">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">


                {{ $payments->links('pagination::bootstrap-5') }}
                <div class="row">
                   @foreach ($payments as $payment)
                    <div class="col-6 my-2">
                        <div class="parent" style="height: 220px">
                            <div class="card h-100 p-2">
                                <div class="card-header">Payment Method</div>
                                <div class="card-body">
                                    <div class="my-2">
                                        <div class="h5 ">Account Name <span class="text-danger "> {{ $payment->account_name }}</span></div>
                                        <span class="text-danger fs-2">{{ $payment->account_number }}</span>
                                        <span class="fs-4 text-info">{{ $payment->account_type }} </span>
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route("payment#edit",$payment->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="{{ route("payment#delete",$payment->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   @endforeach
                </div>
            </>
        </div>
    </div>
@endsection
