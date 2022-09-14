<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management System | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.8/css/fixedHeader.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.8/css/fixedHeader.bootstrap4.min.css">
    <!-- css for datatable buttons -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/1.6.3/css/buttons.dataTables.min.css" />
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">
    <style>
        .container-fluid{
            padding: 25px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        @yield('content')
    </div>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    
        <script src="//cdn.datatables.net/plug-ins/1.10.24/sorting/date-dd-MMM-yyyy.js"></script>
        <script src="https://cdn.datatables.net/fixedheader/3.1.8/js/dataTables.fixedHeader.min.js"></script>

        <script type="text/javascript" charset="utf8"
            src=" https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
        <!-- script files for datatable buttons -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js">
        </script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js">
        </script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.3/js/dataTables.buttons.min.js">
        </script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.3/js/buttons.colVis.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.3/js/buttons.flash.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.3/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.3/js/buttons.print.min.js"></script>
        <script>
            @if (session('info'))
                Swal.fire(  'Info!',  '{{ session("info") }}',  'info')
            @endif
            @if (session('warning'))
                Swal.fire(  'Warning!',  '{{ session("warning") }}',  'warning')
            @endif
            @if (session('success'))
                Swal.fire(  'Success!',  '{{ session("success") }}',  'success')
            @endif
            @if (session('error'))
                Swal.fire(  'Error!',  '{{ session("error") }}',  'error')
            @endif
            
        </script>
        @yield('pagejs')
</body>
</html>