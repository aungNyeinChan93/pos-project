@extends('user.layouts.master')

@section('content')
    <div class="container">
        <div class="p-5"></div>
        <div class="row ">
            <div class="col">
                <div class="card-header">
                    <h1 class="text-center p-2">Order Lists</h1>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <table class="table table-bordered table-hover rounded shadow-sm ">
                    <thead class="bg-primary text-white text-center h4">
                        <tr>
                            <th>Date</th>
                            <th colspan="">Order Code</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-dark text-center">
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->created_at->format('d-m_Y') }}</td>
                                <td>{{ $order->order_id }}</td>
                                <td>
                                    @if ($order->status == 0)
                                        <span class="btn btn-sm btn-warning shadow-sm rounded ">Pending</span>
                                    @elseif($order->status == 1)
                                        <span class="btn btn-sm btn-success shadow-sm rounded ">Confirm</span>
                                    @else
                                        <span class="btn btn-sm btn-danger shadow-sm rounded ">Fail</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
