@extends("user.layouts.master")

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <div class="p-5"></div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card shadow-sm ">
                <div class="card-header">
                    <h4 class="text-primary text-start">Order Detail <span class="h6 text-danger">( {{ $orders[0]->order_id }} )</span></h4>
                </div>
                <div class="card-body">
                    <table class=" table table-bordered table-hover ">
                        <thead class="bg-primary text-white ">
                            <tr>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Customer Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order )
                                <tr>
                                    <td>{{ $order->product->name }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset("/products/".$order->product->photo) }}" alt=""  class=" img-thumbnail rounded w-50">
                                    </td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->product->price }}</td>
                                    <td>{{ $order->amount }}</td>
                                    <td>{{ $order->product->price * $order->amount }}</td>
                                    <td>{{ $order->created_at->format("d-M-Y h-m- A") }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between p-2">
                        <div>
                            <a href="{{ route("payment#orderList") }}">Back</a>
                        </div>
                        <div>
                            <h4 class=" d-inline">Total Amount = ( {{ $totalAmount->total_amount }} MMK )</h4><small class="text-danger "> + delivery</small>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
