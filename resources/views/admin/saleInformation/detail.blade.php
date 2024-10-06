@extends("admin.layouts.master")

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card text-left">
              <div class="card-body">
                <h4 class="card-title">Sale Information <span class="text-danger h5">( {{ $orders[0]->order_id }})</span></h4>
                <table class="table table-hover table-bordered shadow-sm">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Product Name</th>
                            <th>Product Image</th>
                            <th>Price</th>
                            <th>QTY</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Payment Date</th>
                        </tr>
                    </thead>
                    <tbody class="text-center ">
                        @foreach($orders as $key => $order)
                            <tr>
                                <td>{{ $order->product->name }}</td>
                                <td>
                                    <img src="{{ asset("/products/".$order->product->photo) }}" alt="" class=" img-fluid w-50 rounded">
                                </td>
                                <td>{{ $order->product->price }} mmk</td>
                                <td>{{ $order->amount }} pcs</td>
                                <td>{{ $order->amount* $order->product->price }}</td>
                                <td>{{ $paymentHistory->payment_method }}</td>
                                <td>{{ $paymentHistory->created_at->format("d-M-Y h-m A") }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
              <div class="card-footer">
                <div class=" d-flex justify-content-between">
                    <div>
                        Total Amount ({{ $paymentHistory->total_amount }} mmk ) <small class="text-danger"> Include Delivery Fees</small>
                    </div>
                    <a href="{{ route("saleInfo#page") }}" class="btn btn-outline-primary btn-sm my-1">Back</a>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

@endsection
