@extends("admin.layouts.master")

@section("content")

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="row ">
                    <div class="col d-flex justify-content-between ">
                        <div>
                            <a href="{{ url("admins/orders/list?status=1") }}" class="btn btn-primary" style="width: 100px"> Confirm</a>
                            <a href="{{ url("admins/orders/list?status=pending") }}" class="btn btn-warning" style="width: 100px"> Pending</a>
                            <a href="{{ url("admins/orders/list?status=2") }}" class="btn btn-danger" style="width: 100px"> Reject</a>
                        </div>
                        <form action="{{ route("order#list") }}" method="get" >
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="search" class="form-control" placeholder="Order Code " >
                                <button type="submit" class="btn btn-outline-primary" type="button" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                              </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header p-3 h4 text-center text-danger fw-bolder shadow-sm">ORDER BOARD</div>
                </div>

                <table class="table table-bordered table-hover shadow-sm rounded">
                    <thead class="bg-primary text-white ">
                        <tr>
                            <th>Date</th>
                            <th>Order Code</th>
                            <th>User Name</th>
                            <th >Action</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <input type="hidden" name="order_id" class="order_id" value="{{ $order->order_id }}" >
                                <td>{{ $order->created_at->format("d-m-Y h:m A") }}</td>
                                <td><a href="{{ route("order#detail",$order->order_id) }}" class=' text-decoration-none'>{{ $order->order_id }}</a></td>
                                <td>
                                    @if($order->user->name)
                                        {{ $order->user->name }}
                                    @else
                                    {{ $order->user->nickName }}
                                    @endif
                                </td>
                                <td class="hi">
                                    <select name="status" class="form-control status">
                                        <option value="0" @if($order->status ==0)
                                            selected
                                        @endif>Pending</option>
                                        <option value="1" @if($order->status ==1)
                                            selected
                                        @endif>Success</option>
                                        <option value="2" @if($order->status ==2)
                                            selected
                                        @endif>Reject</option>
                                    </select>
                                </td>
                                <td class="text-center">

                                    @if ($order->status == 0)
                                        <span class="text-warning"><i class="fa-solid fa-hourglass-end"></i></span>
                                    @elseif ($order->status == 1)
                                        <span class="text-success"><i class="fa-regular fa-circle-check"></i></span>
                                    @else
                                        <span class="text-danger"><i class="fa-solid fa-xmark"></i></span>
                                    @endif

                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
                {{ $orders->links() }}
            </div>
        </div>
    </div>

    @section('js')
        <script>

            $(document).ready(function(){

                // order-status change
                $(".status").change(function(){
                    $statusValue = $(this).val();
                    $order_id = $(this).parents("tr").find(".order_id").val();
                    $data ={
                        "status":$statusValue,
                        "order_id":$order_id,
                    }

                    $.ajax({
                        type:"get",
                        url:"/admins/orders/changeStatus",
                        dataType:"json",
                        data:$data,
                        success:function(res){
                            res.message == "success"? location.reload() :"";
                        }
                    });

                });
            });
        </script>
    @endsection

@endsection
