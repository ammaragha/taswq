<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Taswq</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ url('backend/vendors/feather/feather.css') }} ">
    <link rel="stylesheet" href="{{ url('backend/vendors/ti-icons/css/themify-icons.css') }} ">
    <link rel="stylesheet" href="{{ url('backend/vendors/css/vendor.bundle.base.css') }} ">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ url('backend/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }} ">
    <link rel="stylesheet" href="{{ url('backend/vendors/ti-icons/css/themify-icons.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ url('backend/js/select.dataTables.min.css') }} ">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('backend/css/vertical-layout-light/style.css') }} ">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('Photos/default.png') }} " />
</head>

<body>
    <div class="container-scroller">

        @include('backend.layouts.nav')

        <div class="container-fluid page-body-wrapper">


            @include('backend.layouts.sidebar')


            <!-- start content -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="col-12  mb-4 mb-xl-0">

                                @yield('content')

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end content -->

        </div>

    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="{{ url('backend/vendors/js/vendor.bundle.base.js') }} "></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ url('backend/vendors/chart.js/Chart.min.js') }} "></script>
    <script src="{{ url('backend/vendors/datatables.net/jquery.dataTables.js') }} "></script>
    <script src="{{ url('backend/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }} "></script>
    <script src="{{ url('backend/js/dataTables.select.min.js') }} "></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ url('backend/js/off-canvas.js') }} "></script>
    <script src="{{ url('backend/js/hoverable-collapse.js') }} "></script>
    <script src="{{ url('backend/js/template.js') }} "></script>
    <script src="{{ url('js/settings.js') }} "></script>
    <script src="{{ url('backend/js/todolist.js') }} "></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ url('backend/js/dashboard.js') }} "></script>
    <script src="{{ url('backend/js/Chart.roundedBarCharts.js') }} "></script>
    <!-- End custom js for this page-->

    <!-- my js -->
    <script src="{{ url('backend/js/mine.js') }} "></script>

</body>

</html>
