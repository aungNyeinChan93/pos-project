@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <a href="{{ route("order#list") }}" class="btn btn-sm btn-primary my-2">Back</a>
        <div class="row">
            <div class="col-6">
                <div class="card p-2">
                    <div class="row p-3">
                        <div class="col-5">Name</div>
                        <div class="col-7">{{ $paymentHistory->user_name }}</div>
                    </div>
                    <div class="row p-3">
                        <div class="col-5">Phone</div>
                        <div class="col-7">
                            @if ($orders[0]->user->phone == $paymentHistory->user_name)
                                {{ $orders[0]->user->phone }}
                            @else
                                {{ $paymentHistory->user_phone }} , {{ $orders[0]->user->phone }}
                            @endif
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-5">Address</div>
                        <div class="col-7">{{ $paymentHistory->user_address }}</div>
                    </div>
                    <div class="row p-3">
                        <div class="col-5">Order Code</div>
                        <div class="col-7">{{ $paymentHistory->order_id }}</div>
                    </div>
                    <div class="row p-3">
                        <div class="col-5">Order Date</div>
                        <div class="col-7">{{ $paymentHistory->created_at->format('d-M-Y H-M A') }}</div>
                    </div>
                    <div class="row p-3">
                        <div class="col-5">Total Price <span  class="text-danger d-block"> Delivery Fees include</span></div>
                        <div class="col-7">{{ $paymentHistory->total_amount }} MMK</div>
                    </div>

                </div>
            </div>
            <div class="col-6">
                <div class="card p-2">
                    <div class="row p-3">
                        <div class="col-5">Payment Method</div>
                        <div class="col-7">{{ $paymentHistory->payment_method }}</div>
                    </div>
                    <div class="row p-3">
                        <div class="col-5">Purchase Date</div>
                        <div class="col-7">{{ $paymentHistory->created_at->diffForHumans() }}</div>
                    </div>
                    <div class="row p-3">
                            <img src="{{ asset('/paymentSlip/' . $paymentHistory->payment_image) }}" alt="payslip"
                                class=" img-fluid w-50  ">
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <div class="card shadow-sm my-2">
                    <div class="card-header bg-secondary text-white">
                        <h4 class="text-center ">Order Board </h4>
                    </div>
                    <table class=" table table-bordered table-hover text-start">
                        <thead class="bg-primary text-white text-center p-2">
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Quality</th>
                                <th>Avaliable Stock</th>
                                <th>Product Price (Each)</th>
                                <th>Total Price  </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td>
                                    @if($order->user->name)
                                        {{ $order->user->name }}
                                    @else
                                        {{ $order->user->nickName }}
                                    @endif
                                </td>
                                <td>
                                    <img src="{{ asset("/products/".$order->product->photo) }}"  alt="product" class="img-fluid w-50 rounded">
                                </td>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->amount }}</td>
                                <td>{{ $order->product->stock }}</td>
                                <td>{{ $order->product->price }} mmk</td>
                                <td>{{ $order->amount*$order->product->price }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


               <div class="row">
                <div class="col-3 offset-9">
                    <div class="row my-2">
                        <div class="col-6">
                            <form action="{{ route("order#orderConfirm",$paymentHistory->order_id) }}" method="post">
                                @csrf
                                <input type="submit" class="btn btn-outline-primary me-1" value="Order Confrim">
                            </form>
                        </div>
                        <div class="col-6">
                            <form action="{{ route("order#orderReject",$paymentHistory->order_id) }}" method="post">
                                @csrf
                                <input type="submit" class="btn btn-outline-danger me-1" value="Order Reject">
                            </form>
                        </div>
                    </div>
                </div>
               </div>
            </div>
        </div>
    </div>
@endsection
