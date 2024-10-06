@extends("admin.layouts.master")

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h1>Sale Infromation</h1>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover shadow-sm rounded-3">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Order Code</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>
                                            <span class="text-info text-capitalize">{{ $order->user->name !=null ? $order->user->name : $order->user->nickName }}</span>
                                        </td>
                                        <td> <a href="{{ route("saleInfo#detail",$order->order_id) }}" class=" text-decoration-none text-danger"> {{ $order->order_id }}</a></td>
                                        <td><span>{{ $order->created_at->format("d-F-Y h-m-s A") }}</span></td>
                                        <td class="text-center">
                                            <a href="{{ route("saleInfo#detail",$order->order_id) }}" class="btn btn-warning btn-sm rounded-pill py-1 text-white "> View </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
