@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <div class="count">
                <button disabled class="btn btn-info rounded-3 shadow">
                    @if(count($products)<=1 )
                        Total Product ({{ count($products) }})
                    @elseif (count($products) >1 )
                        Total Products ({{ count($products) }})
                    @endif
                </button>
                <a href="{{ route("product#listPage") }}" class="btn btn-outline-info ">All Products </a>
                <a href="{{ route("product#listPage","lowStock") }}" class="btn btn-outline-danger ">Low Stock </a>
                <a href="{{ route("product#listPage","highStock") }}" class="btn btn-outline-danger ">High Stock </a>
            </div>
            <form action="" method="GET">
                @csrf
                <div class="input-group  mb-3">
                    <input type="text" name="searchKey" value="{{ old("searchKey") }}" class="form-control" placeholder="Search...">
                    <button class="btn btn-outline-primary" type="submit" >Search</button>
                </div>
            </form>
        </div>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-3">
                    <div class="card my-2  shadow-sm" style="height: 450px">
                        <div class="card-header bg-primary  text-white">
                            <h5 class="text-center">{{ $product->name }}</h5>
                        </div>
                        <div class="card-body">
                            <img src="{{ asset("/products/$product->photo") }}" style="height:180px"
                                class=" img-fluid w-100 p-4 object-contain">
                            <div class="d-flex justify-content-around my-4">
                                <div class="h5   text-danger self-start">{{ $product->price }}</div>
                                <div class="">
                                    <button type="button"
                                        class="btn btn-sm bg-secondary text-white position-relative rounded shadow-sm">
                                        {{ $product->stock }}
                                        @if ($product->stock <= 3)
                                            <span
                                                class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-danger">
                                                <span class="visually-hidden text-white">less Stock</span>
                                            </span>
                                        @endif
                                    </button>
                                </div>
                            </div>
                            <div> Category <small class="fs-4 text-danger ">{{ $product->categoryName }}</small></div>
                            <span class="my-2 text-muted d-block"> {{ Str::limit($product->description, 20, '...') }}</span>
                            <div class="btn-group my-2">
                                <a href="{{ route('product#detail', $product->id) }}" class="btn btn-sm btn-info">Detail</a>
                                <a href="{{ route("product#edit",$product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route("product#delete",$product->id) }}" method="post">
                                    @csrf
                                    @method("delete")
                                    <button  class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
