@extends("user.layouts.master")

@section("content")


    <!-- Single Page Header start -->
    {{-- <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Cart</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Cart</li>
        </ol>
    </div> --}}
    <!-- Single Page Header End -->

    <!-- Cart Page Start -->
    <div class="container-fluid py-5 ">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table" id="cartTable">
                    <thead>
                      <tr>
                        <th scope="col">Products</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Handle</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset("products/".$product->photo) }}" class="img-fluid shadow-sm  me-5 rounded-circle object-cover" style="width: 80px; height: 80px;" alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{ $product->name }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4 price">{{ $product->price }} MMK</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center border-0 qty" value="{{ $product->Qty }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4 total">{{ $product->price * $product->Qty }} MMK</p>
                                </td>
                                <td>
                                    <input type="hidden" class="cart_id" value="{{ $product->cart_id }}">
                                    <button class="btn btn-md rounded-circle bg-light border mt-4 remove-btn" >
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="mt-5">
                <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
                <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" id="allProducts" type="button">Apply Coupon</button>
            </div>
            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0" id="subTotal">{{ $total }}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Deli</h5>
                                <div class="">
                                    <p class="mb-0" >10000 MMK</p>
                                </div>
                            </div>
                            {{-- <p class="mb-0 text-end">Shipping to Ukraine.</p> --}}
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p id="netTotal" class="mb-0 pe-4">{{ $total +10000 }} MMK</p>
                        </div>
                        <button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Proceed Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->




    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>



@endsection


@section('js')
    <script>
        $(document).ready(function(){

            //btn-plus
            $(".btn-plus").click(function(){
                $parentNode = $(this).parents("tr");
                $price = $parentNode.find(".price").text().replace("MMK","")
                $qty = $parentNode.find(".qty").val()
                $parentNode.find(".total").text($price*$qty+" MMK");
                finalResult();
            })

            //btn-minus
            $(".btn-minus").click(function(){
                $parentNode = $(this).parents("tr")
                $price = $parentNode.find(".price").text().replace(" MMK","")
                $qty = $parentNode.find(".qty").val()
                $parentNode.find(".total").text($price*$qty+" MMK");
                finalResult();
            })

            // delete cart-products
            $(".remove-btn").click(function(){
                $parentNode = $(this).parents("tr");
                $cart_id = $parentNode.find(".cart_id").val();
                $data = {
                    "cartId":$cart_id,
                }
                $.ajax({
                    type:"get",
                    url:"/users/products/cart/delete",
                    dataType:"json",
                    data:$data,
                    success:function(res){
                        console.log(res.products);
                        res.products == "" ? location.reload():"";
                    }
                });
                $parentNode.remove();
                finalResult();
            })

            function finalResult(){
                $total = 0;
                $("#cartTable tbody tr").each(function(index,item){
                        $total += parseInt($(item).find(".total").text().replace("MMK",""));
                        // console.log($total);
                        $("#subTotal").html(`${$total} MMK`)
                        $("#netTotal").html(`${$total+10000} MMK`)
                })
            }

            // all product
            $("#allProducts").click(function(){
                $.ajax({
                    type :"get",
                    url:"/users/products/list",
                    dataType:"json",
                    success:function(response){
                        console.log(response);
                    }
                });
            })

        })
    </script>
@endsection
