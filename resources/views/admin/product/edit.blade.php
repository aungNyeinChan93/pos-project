@extends("admin.layouts.master")

@section('content')

    <div class="container">
        <div class="container">
            <div class="row my-2">
                <div class="col-8 offset-2">
                   <div class="div p-2 rounded shadow-sm">
                    <form action="{{ route("product#update",$product->id) }}" method="POST" enctype="multipart/form-data" class="p-2">
                        @csrf
                        @method("put")

                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="mb-3 text-center">
                            <img
                            src="{{ asset("/products/$product->photo") }}" alt="test"
                            id="output"
                            class=" img-profile  my-2 p-2 rounded shadow "
                            style="width: 350px "
                            >

                            <input type="file" name="photo" class="form-control form-control-file mt-3
                            @error("photo")
                                is-invalid
                            @enderror"
                            onchange="loadFile(event)"
                            >
                            @error("photo")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="text"
                                class="form-control
                            @error('name')
                                is-invalid
                            @enderror"
                                id="name" name="name"
                                value="{{ old("name",$product->name) }}"
                                placeholder="Product Name"
                                >
                            @error('name')
                                <div class="alert alert-warning mt-2">
                                    <small class="text-danger">{{ $message }}</small>
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <select name="category_id" class="form-control">
                                <option value="">Choose Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                    @if ( old("category_id",$product->category_id)== $category->id )
                                        selected
                                    @endif>
                                    {{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="alert alert-warning mt-2">
                                    <small class="text-danger">{{ $message }}</small>
                                </div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <div class="mb-3">
                                    <input type="text"
                                        class="form-control
                                    @error('price')
                                        is-invalid
                                    @enderror"
                                        id="price" name="price"
                                        value="{{ old("price",$product->price) }}"
                                        placeholder="price "
                                        >
                                    @error('price')
                                        <div class="alert alert-warning mt-2">
                                            <small class="text-danger">{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <input type="number"
                                        class="form-control
                                    @error('stock')
                                        is-invalid
                                    @enderror"
                                        id="stock" name="stock"
                                        placeholder="stock"
                                        value="{{ old("stock",$product->stock) }}"
                                        >
                                    @error('stock')
                                        <div class="alert alert-warning mt-2">
                                            <small class="text-danger">{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <textarea name="description" cols="30"  rows="10" class="form-control">{{ old("description",$product->description) }} </textarea>
                                @error('description')
                                        <div class="alert alert-warning mt-2">
                                            <small class="text-danger">{{ $message }}</small>
                                        </div>
                                @enderror
                        </div>

                        <div class="mb-1">
                            <input type="submit" value="Submit" class="btn btn-sm btn-primary">
                            <a href="{{ route("product#listPage") }}" class="btn btn-sm btn-secondary "> Back</a>
                        </div>

                    </form>
                   </div>
                </div>
            </div>
        </div>
    </div>

@endsection
