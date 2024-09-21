@extends('admin.layouts.master')

@section("content")

    <div class="container-fulid">
        <div class="row">
            <div class="col-10 offset-1">
                <div class="card shadow-sm rounded-3">
                    <div class="card-header text-center h3">
                        {{ $product->name }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <img src="{{ asset("/products/$product->photo") }}" class="img-fluid w-100    rounded-4 shadow-sm">
                                <a href="{{ route("product#listPage") }}" class="btn btn-sm btn-secondary my-4">Back</a>
                            </div>
                            <div class="col-6">
                               <strong> PRICE </strong> <small class="text-danger"> {{ $product->price }} MMK</small><br><br>
                               <strong> STOCK </strong> <small class="text-danger"> {{ $product->stock }} unit</small><br><br>
                               <p class="text-muted my-1">
                                <h3>Description</h3>
                                {{ $product->description}}
                               </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
