@extends('user.layouts.master')

@section('content')
    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords"
                            aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->

    <!-- Single Product Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <div class="row">
                        <div class="col">
                            @if (session('rating'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>{{ session('rating') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                    </div>

                    <a href="{{ route('userHome') }} " class="btn btn-sm btn-outline-primary my-2 ">Home</a> >>
                    <a href="" class="btn btn-sm btn-secondary my-2">Total View Counts {{ $total_viewCount }}</a>
                    <div class="row g-4">

                        <div class="col-lg-6">
                            <div class="border rounded">
                                <div href="#">
                                    <img src="{{ asset('/products/' . $product->photo) }}"
                                        class="img-thumbnailrounded p-2 shadow-sm w-100 object-cover" alt="Image">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="fw-bold mb-3 fs-2">{{ $product->name }}</h4>
                            <h4 class="mb-3"><em class="fs-5">Avaliable Stock</em> <span class="text-primary fs-3">(
                                    {{ $product->stock }} pcs ) </span></h4>
                            <h5 class="mb-3 ">
                                <span>Category: <strong class="text-primary">{{ $product->categoryName }}</strong> </span>
                                <span class="ms-4 text-danger"><i class="fa-regular fa-eye"></i>
                                    {{ count($user_viewCount) }} </span>
                            </h5>
                            <h5 class="fw-bold mb-3">{{ $product->price }} mmk</h5>
                            <div class="d-flex mb-4">

                                @for ($i = 0; $i < $avgRating; $i++)
                                    <i class="fa fa-star text-secondary"></i>
                                @endfor

                                @for ($j = $avgRating; $j < 5; $j++)
                                    <i class="fa fa-star"></i>
                                @endfor

                            </div>

                            <div class="">
                                <p class="mb-4">{{ Str::limit($product->description, 50, '...') }}</p>
                            </div>
                            <form action="{{ route('userProduct#addcart') }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="input-group quantity mb-5" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="qty"
                                        class="form-control form-control-sm text-center border-0" value="1">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="submit" href="#"
                                    class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i>
                                    Add to cart
                                </button>

                                <button type="button" data-bs-toggle="modal" data-bs-target="#rating"
                                    class="ms-1 btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"><i
                                        class="fa fa-star me-2 text-primary"></i>
                                    Rating
                                </button>
                            </form>

                            {{-- Rating model  --}}
                            <form action="{{ route('rating#create') }}" method="POST">
                                @csrf
                                <div class="modal" tabindex="-1" id="rating">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Let start rating</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="rating-css">
                                                    <div class="star-icon">
                                                        @if ($userRating == null)
                                                            <input type="radio" name="rating" value="1" checked
                                                                id="rating1">
                                                            <label for="rating1"><i class="fa fa-star"></i></label>

                                                            <input type="radio" name="rating" value="2"
                                                                id="rating2">
                                                            <label for="rating2"><i class="fa fa-star"></i></label>

                                                            <input type="radio" name="rating" value="3"
                                                                id="rating3">
                                                            <label for="rating3"><i class="fa fa-star"></i></label>

                                                            <input type="radio" name="rating" value="4"
                                                                id="rating4">
                                                            <label for="rating4"><i class="fa fa-star"></i></label>

                                                            <input type="radio" name="rating" value="5"
                                                                id="rating5">
                                                            <label for="rating5"><i class="fa fa-star"></i></label>
                                                        @else
                                                            @for ($i = 1; $i <= $userRating; $i++)
                                                                <input type="radio" name="rating"
                                                                    value="{{ $i }}" checked
                                                                    id="rating{{ $i }}">
                                                                <label for="rating{{ $i }}"><i
                                                                        class="fa fa-star"></i></label>
                                                            @endfor

                                                            @for ($j = $userRating + 1; $j <= 5; $j++)
                                                                <input type="radio" name="rating"
                                                                    value="{{ $j }}"
                                                                    id="rating{{ $j }}">
                                                                <label for="rating{{ $j }}"><i
                                                                        class="fa fa-star"></i></label>
                                                            @endfor
                                                        @endif

                                                    </div>
                                                </div>

                                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>


                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button"
                                        role="tab" id="nav-about-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-about" aria-controls="nav-about"
                                        aria-selected="true">Description </button>
                                    <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                        id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                        aria-controls="nav-mission" aria-selected="false">Comments <small
                                            class="btn btn-sm btn-secondary rounded-pill shadow-sm">{{ count($comments) }}</small></button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-about" role="tabpanel"
                                    aria-labelledby="nav-about-tab">
                                    <p>{{ $product->description }}</p>
                                </div>

                                {{-- comment --}}
                                <div class="tab-pane" id="nav-mission" role="tabpanel"
                                    aria-labelledby="nav-mission-tab">
                                    @foreach ($comments as $comment)
                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                                <img src="{{ asset('profile/' . $comment->user->profile_image) }}"
                                                    class="img-fluid object-cover rounded-circle p-3"
                                                    style="width: 100px; height: 100px;" alt="">
                                                <div class="">
                                                    <p class="mb-2" style="font-size: 14px;">
                                                        {{ $comment->created_at->diffForHumans() }}</p>
                                                    <div class="d-flex justify-content-between">
                                                        <h5>{{ $comment->user->name != null ? $comment->user->name : $comment->user->nickName }}
                                                        </h5>
                                                    </div>
                                                    <p>{{ $comment->comment }}</p>
                                                </div>
                                            </div>
                                            <div class="pt-4">
                                                @can('delete', $comment)
                                                    <form action="{{ route('comment#delete', $comment->id) }}" method="POST">
                                                        @csrf
                                                        <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                                                    </form>
                                                @endcan
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach

                                </div>
                                <div class="tab-pane" id="nav-vision" role="tabpanel">
                                    <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor
                                        sit. Aliqu diam
                                        amet diam et eos labore. 3</p>
                                    <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos
                                        labore.
                                        Clita erat ipsum et lorem et sit</p>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('comment#create') }}" method="POST">
                            @csrf
                            <h4 class="mb-5 fw-bold text-primary">Comments</h4>
                            <div class="row g-4">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input type="text" readonly
                                            value="{{ auth()->user()->name != null ? Auth::user()->name : Auth::user()->nickName }}"
                                            class="form-control border-0 me-4" placeholder="Yur Name *">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input type="email" readonly value="{{ Auth::user()->email }}"
                                            class="form-control border-0" placeholder="Your Email *">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="border-bottom rounded my-4">
                                        <textarea name="comment" id="" class="form-control border-0" cols="30" rows="8"
                                            placeholder="Your Comment *" spellcheck="false"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between py-3 mb-5">
                                        <div class="d-flex align-items-center">
                                        </div>
                                        <button type="submit"
                                            class="btn border border-secondary text-primary rounded-pill px-4 py-3"> Post
                                            Comment</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            {{-- related product carts --}}
            @if (count($relativeProducts) >= 1)
                <h1 class="fw-bold mb-0 text-primary">Related Products</h1>
            @endif

            @if (count($relativeProducts) >= 4)
                <div class="owl-carousel vegetable-carousel justify-content-center my-4">
                    @foreach ($relativeProducts as $relativeProduct)
                        <div class="border border-primary rounded position-relative vesitable-item "
                            style="height: 400px">
                            <div class="vesitable-img" style="height: 200px">
                                <a href="{{ route('userProduct#detail', $relativeProduct->id) }}">
                                    <img src="{{ asset("products/$relativeProduct->photo") }}"
                                        class="img-fluid w-100 rounded-top p-2" alt="">
                                </a>
                            </div>
                            <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                                style="top: 10px; right: 10px;">{{ $relativeProduct->categoryName }}</div>
                            <div class="p-4 pb-0 rounded-bottom">
                                <h4>{{ $relativeProduct->name }}</h4>
                                <p>{{ Str::limit($relativeProduct->description, 20, '...') }}</p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fs-5 fw-bold">{{ $relativeProduct->price }} MMK</p>
                                    <form action="{{ route('userProduct#addcart') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="product_id" value="{{ $relativeProduct->id }}">
                                        <input type="hidden" name="qty" value="1">
                                        <button type=submit
                                            class="w-100 btn border border-secondary rounded-pill px-3 text-primary"><i
                                                class="fa fa-shopping-bag me-2 text-primary"></i> Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="vesitable my-2 py-2">
                    <div class="row">
                        @foreach ($relativeProducts as $relativeProduct)
                            <div class="col-3">
                                <div class="border border-primary rounded position-relative vesitable-item"
                                    style="height: 400px">
                                    <div class="vesitable-img" style="height: 200px">
                                        <a href="{{ route('userProduct#detail', $relativeProduct->id) }}">
                                            <img src="{{ asset("products/$relativeProduct->photo") }}"
                                                class="img-fluid w-100 rounded-top" alt="">
                                        </a>
                                    </div>
                                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                                        style="top: 10px; right: 10px;">{{ $relativeProduct->categoryName }}</div>
                                    <div class="p-4 pb-0 rounded-bottom">
                                        <h4>{{ $relativeProduct->name }}</h4>
                                        <p>{{ Str::limit($relativeProduct->description, 20, '...') }}</p>
                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                            <p class="text-dark fs-5 fw-bold">{{ $relativeProduct->price }} MMK</p>
                                            <form action="{{ route('userProduct#addcart') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                <input type="hidden" name="product_id"
                                                    value="{{ $relativeProduct->id }}">
                                                <input type="hidden" name="qty" value="1">
                                                <button type=submit
                                                    class="w-100 btn border border-secondary rounded-pill px-3 text-primary"><i
                                                        class="fa fa-shopping-bag me-2 text-primary"></i> Cart</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- Single Product End -->




    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>




@endsection
