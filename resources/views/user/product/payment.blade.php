@extends('user.layouts.master')

@section('content')
    <div class="p-5"></div>
    <div class="container">
        <div class="row p-2 py-4 shadow-sm rounded-3 bg-primary ">
            <div class="col-5">
                <div class="card">
                    <div class=" p-3">
                        <h4 class="text-center text-muted">Payment Methods</h4>
                        <div class="card-body">
                            @foreach ($payments as $payment)
                                <div>
                                    <strong> {{ $payment->account_type }}</strong><br>
                                    <small>Account Number : <span class="text-danger">
                                            {{ $payment->account_number }}</span></small>
                                    <hr>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">Payment Info</div>
                    <div class="card-body">
                        <form action="{{ route("payment#order") }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row my-3">
                                <div class="col">
                                    <input type="text" readonly name="name" value="{{ Auth::user()->name }}" placeholder="name" class=" form-control @error("name")
                                        is-invalid
                                    @enderror">
                                </div>
                                <div class="col">
                                    <input type="text" name="phone" value="{{ old("phone",Auth::user()->phone) }}" placeholder="phone" class="form-control @error("phone")
                                        is-invalid
                                    @enderror">
                                </div>
                                <div class="col">
                                    <input type="text" name="address" value="{{ old("address",Auth::user()->address) }}" placeholder="address" class="form-control @error("address")
                                        is-invalid
                                    @enderror">
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col">
                                    <select name="payment" class="form-control @error("payment")
                                        is-invalid
                                    @enderror">
                                        <option value="">Choose Payment</option>
                                        @foreach($payments as $payment)
                                            <option value="{{ $payment->account_name }}" @if($payment->account_name == $payment->account_name)
                                                selected
                                            @endif>{{ $payment->account_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <input type="file" name="payment_image" class="form-control @error("payment_image")
                                        is-invalid
                                    @enderror">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="hidden" name="order_id" value="{{ $orderLists[0]["order_id"] }}">
                                    <strong>Order Code</strong> : <span class="text-secondary">{{ $orderLists[0]["order_id"] }}</span>
                                </div>
                                <div class="col">
                                    <input type="hidden" name="total_amount" value="{{ $orderLists[0]["total_amount"] }}">
                                    <strong>Total Amount</strong> : <span>{{ $orderLists[0]["total_amount"] }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 p-3">
                                    <button class="btn btn-outline-primary w-100" type="submit"> Order </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
