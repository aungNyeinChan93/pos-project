@extends("user.layouts.master")

@section("content")
    <div class="p-5">   </div>
    <div class="container-fluid">
        <h1>Payment Page</h1>
       <div class="row">
        <div class="col">
            <table class="table table-hover table-bordered">
                <thead class="bg-success text-white ">
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($orders as $order)
                       <tr>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->price }}</td>
                            <td class="">{{ $order->amount }}</td>

                       </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
        <div class="col">

        </div>
       </div>


    </div>

@endsection
