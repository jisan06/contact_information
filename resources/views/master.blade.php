<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{@$title}} </title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="{{asset('public/asset')}}/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{asset('public/asset')}}/css/style.css" rel="stylesheet">

    <!--alerts CSS -->
    <link href="{{asset('public/asset')}}/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

    <link id="jquiCSS" rel="stylesheet" href="{{asset('public/asset')}}/css/jquery-ui.css" type="text/css" media="all">

</head>

<body class="skin-default fixed-layout">
    <div id="main-wrapper">
        <div class="container">
            <div class="card">
                @yield('content')
            </div>
        </div>
    </div>

<script src="{{asset('public/asset/')}}/js/jquery-3.2.1.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="{{asset('public/asset/')}}/js/bootstrap.min.js"></script>

<script src="{{asset('public/asset/')}}/js/jquery.dataTables.min.js"></script>

<script src="{{asset('public/asset/')}}/js/custom.min.js"></script>

<script src="{{asset('public/asset')}}/sweetalert/sweetalert.min.js"></script>

<script src="{{asset('public/asset')}}/sweetalert/jquery.sweet-alert.custom.js"></script>

<script>
    $(document).ready(function() {
        $('.alert-success').fadeIn().delay(7000).fadeOut();
    });
</script>
<script>
    $(function() {
        $( ".add_datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy',
            yearRange: '1910:'+(new Date).getFullYear(),
        }).datepicker('setDate', 'today');

        $( ".datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy',
            yearRange: '1990:'+(new Date).getFullYear(),
        });
    });
</script>

<script>
    $(document).ready(function() {
        var table = $('.datatable').DataTable({
            "orderable": false,
            "pageLength": 30,
            "lengthMenu": [
                [10, 20, 30, 50, 80, 100, 150, 200, -1],
                [10, 20, 30, 50, 80, 100, 150, 200, "All"]
            ],
        });
        table.on('order.dt search.dt', function() {
            table.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
    });
</script>

<!-- script for go back -->
<script type="text/javascript">
    function goBack() {
        window.history.go(-1);
    }

</script>

@yield('custom_js')

</body>
</html>