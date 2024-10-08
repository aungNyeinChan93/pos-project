<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    @vite(['resources/js/app.js'])

    <title>POS Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href=" {{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route("adminHome") }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">POS Project</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('adminHome') }}"><i class="fas fa-fw fa-table"></i><span>Dashboard
                    </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('category#list') }}"><i
                        class="fa-solid fa-circle-plus"></i></i><span>Category </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route("product#createPage") }}"><i class="fa-solid fa-sitemap"></i></i><span>Add Products </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route("product#listPage") }}"><i class="fa-solid fa-layer-group"></i><span>Products List
                    </span></a>
            </li>

            @if(Auth::user()->role == "superAdmin")
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("payment#list") }}"><i class="fa-solid fa-credit-card"></i></i><span>Payment Method
                        </span></a>
                </li>
            @endif

            <li class="nav-item">
                <a class="nav-link" href="{{ route("saleInfo#page") }}"><i class="fa-solid fa-list"></i><span>Sale Information </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route("order#list") }}"><i class="fa-solid fa-cart-shopping"></i><span>Order Board
                    </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route("adminContact#index") }}"><i class="fa-regular fa-address-book"></i><span> Contact Info </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route("profile#page") }}"><i class="fa-solid fa-gear"></i></i><span>Setting</span></a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="{{ route('password#show') }}"><i
                        class="fa-solid fa-lock"></i></i></i><span>Change Password
                    </span></a>
            </li>

            <li class="nav-item">
                <form class="" action="{{ route('logout') }} " method="POST">
                    @csrf
                    <button class="btn nav-link" type="submit">
                        <a class="nav-link"><i class="fa-solid fa-right-from-bracket"></i><span>Logout </span></a>
                </form>
            </li>
        </ul>
        <!-- End of Sidebar -->


        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset(Auth::user()->profile_image == null ?"admin/img/undraw_profile.svg": "/profile/".Auth::user()->profile_image) }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('profile#page') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                {{-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Setting
                                </a> --}}
                                @if(Auth::user()->role == "superAdmin")
                                    <a class="dropdown-item" href="{{ route("profile#adminAccCreate") }}">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Create Admin Account
                                    </a>
                                @endif
                                @if(Auth::user()->role == "superAdmin")
                                    <a class="dropdown-item" href="{{ route('adminList#index') }}">
                                        <i class="fas fa-users fa-sm fa-fw mr-2 text-gray-400"></i></i></i>
                                        Manage Admin List
                                    </a>
                                    <a class="dropdown-item" href="{{ route('userList#index') }}">
                                        <i class="fas fa-users fa-sm fa-fw mr-2 text-gray-400"></i></i></i>
                                        Manage User List
                                    </a>
                                @endif
                                <a class="dropdown-item" href="{{ route('password#show') }}">
                                    <i class="fa-solid fa-lock fa-sm fa-fw mr-2 text-gray-400"></i></i></i>
                                    Change Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400">
                                    </i>

                                    <form action="{{ route('logout') }}" method="POST" class=" d-inline">
                                        @csrf
                                        <input type="submit" value="Logout" class="btn btn-sm btn-outline-primary">
                                    </form>

                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')
                    @include('sweetalert::alert')

                </div>

                <!-- Bootstrap core JavaScript-->
                <script src=" {{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
                <script src=" {{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

                <!-- Core plugin JavaScript-->
                <script src=" {{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>


                <!-- Custom scripts for all pages-->
                <script src=" {{ asset('admin/js/sb-admin-2.min.js') }}"></script>

                <!-- Page level plugins -->
                <script src=" {{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>

                <!-- Page level custom scripts -->
                <script src=" {{ asset('admin/js/demo/chart-area-demo.js') }}"></script>
                <script src=" {{ asset('admin/js/demo/chart-pie-demo.js') }}"></script>

                <script>
                    function loadFile(event) {
                        var reader = new FileReader();
                        reader.onload = function() {
                            let image = document.getElementById("output");
                            image.src = reader.result;
                        }
                        reader.readAsDataURL(event.target.files[0]);
                    }
                </script>

                @yield("js")

</body>

</html>
