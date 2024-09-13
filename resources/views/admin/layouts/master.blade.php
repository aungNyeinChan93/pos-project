<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href=" {{asset("admin/css/sb-admin-2.min.css")}}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Code Lab Studio</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-fw fa-table"></i><span>Dashboard </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa-solid fa-circle-plus"></i></i><span>Category </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa-solid fa-sitemap"></i></i><span>Add Category </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa-solid fa-layer-group"></i><span>Product Details </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa-solid fa-plus"></i></i><span>Add Item </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa-solid fa-credit-card"></i></i><span>Payment Method </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa-solid fa-list"></i><span>Sale Information </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"></i><span>Order Board </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa-solid fa-gear"></i></i><span>Setting </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa-solid fa-lock"></i></i></i><span>Change Password </span></a>
            </li>

            <li class="nav-item">
                <form action="{{ route("logout") }} " method="POST">
                    @csrf
                    <button class="btn nav-link" type="submit">
                        <a class="nav-link"><i class="fa-solid fa-right-from-bracket"></i></i><span>Logout </span></a>
                    </span>
                </form>
            </li>
        </ul>
        <!-- End of Sidebar -->

        @yield('content')

    <!-- Bootstrap core JavaScript-->
    <script src=" {{asset("admin/vendor/jquery/jquery.min.js")}}"></script>
    <script src=" {{asset("admin/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>

    <!-- Core plugin JavaScript-->
    <script src=" {{asset("admin/vendor/jquery-easing/jquery.easing.min.js")}}"></script>

    <!-- Custom scripts for all pages-->
    <script src=" {{asset("admin/js/sb-admin-2.min.js")}}"></script>

    <!-- Page level plugins -->
    <script src=" {{asset("admin/vendor/chart.js/Chart.min.js")}}"></script>

    <!-- Page level custom scripts -->
    <script src=" {{asset("admin/js/demo/chart-area-demo.js")}}"></script>
    <script src=" {{asset("admin/js/demo/chart-pie-demo.js")}}"></script>

</body>

</html>
