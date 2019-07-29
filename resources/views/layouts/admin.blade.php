<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ url('/') }}/images/favicon.png" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Super Admin</title>

    <!-- Styles -->
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{url('/')}}/css/admin/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{url('/')}}/css/admin/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('/')}}/css/admin/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{url('/')}}/css/admin/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{url('/')}}/css/admin/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{url('/')}}/css/admin/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{url('/')}}/css/admin/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{url('/')}}/css/admin/daterangepicker.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{url('/')}}/css/admin/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="{{url('/')}}/css/admin/croppie.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css">

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.print.css"> -->


    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- jQuery 3 -->
    <script src="{{url('/')}}/js/admin/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{url('/')}}/js/admin/jquery-ui.min.js"></script>

    <!-- Bootstrap 3.3.7 -->
    <script src="{{url('/')}}/js/admin/bootstrap.min.js"></script>

    <script src="{{url('/')}}/js/admin/jquery.dataTables.min.js"></script>
    <script src="{{url('/')}}/js/admin/dataTables.bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="{{url('/')}}/js/admin/raphael.min.js"></script>
    <script src="{{url('/')}}/js/admin/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="{{url('/')}}/js/admin/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="{{url('/')}}/js/admin/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="{{url('/')}}/js/admin/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{url('/')}}/js/admin/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="{{url('/')}}/js/admin/moment.min.js"></script>
    <script src="{{url('/')}}/js/admin/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="{{url('/')}}/js/admin/bootstrap-datepicker.min.js"></script>
    <!-- Slimscroll -->
    <script src="{{url('/')}}/js/admin/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="{{url('/')}}/js/admin/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="{{url('/')}}/js/admin/adminlte.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{url('/')}}/js/admin/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{url('/')}}/js/admin/demo.js"></script>
    <script src="{{url('/')}}/js/admin/croppie.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <style>
        label.error{color: red; font-weight: 400; font-style: italic;}
        #avg_rating i.active{ color: #efbb1e; }
    </style>

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        @component('components.admin_header')
        @endcomponent

        @component('components.admin_sidebar')
        @endcomponent

        <div class="content-wrapper">
            @yield('content')
        </div>

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
            </div>
            <strong>Copyright</strong>
        </footer>
        <div class="control-sidebar-bg"></div>

    </div>
</body>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<script>
  $(function () {
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true
    })

    $('.summernote').summernote({
        height: 250
    });

  })
</script>

<script>
$(document).ready(function(){
  $('[data-toggle="popover"]').popover(); 
});
</script>

</html>
