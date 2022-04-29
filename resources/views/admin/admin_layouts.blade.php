<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Coaching | User</title>
    <!--    Font Awesome Stylesheet-->
    <link rel="stylesheet" href="{{ asset('/public/admin/fonts/fa/css/all.min.css') }}">
    <!--    Animate CSS-->
    <link rel="stylesheet" href="{{ asset('/public/admin/css/animate.css') }}">
    <!--    Owl Carosel Stylesheets-->
    <link rel="stylesheet" href="{{ asset('/public/admin/plugins/owl-carosel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/admin/plugins/owl-carosel/css/owl.theme.default.css') }} ">
    <!--    Magnetic Popup-->
    <link rel="stylesheet" href="{{ asset('/public/admin/plugins/magnific-popup/css/magnific-popup.css') }}">
    <!--    Bootstrap-4.3 Stylesheet-->
    <link rel="stylesheet" href="{{ asset('/public/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/admin/css/sub-dropdown.css') }}">
    <!--    Data Table CSS-->
    <link rel="stylesheet" href="{{ asset('/public/admin/plugins/data-table/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/admin/plugins/data-table/css/fixedHeader.bootstrap4.min.css') }}">
    <!--    Theme Stylesheet-->
    <link rel="stylesheet" href="{{ asset('/public/admin/css/style.css') }}">
    <!--    jQuery-->
    <script src="{{asset('/public/admin/js/jquery-3.4.1.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    <!--    Favicon-->
    <link rel="shortcut icon" href="{{ asset('/public/admin/images/favicon.png" type="image/x-icon') }}">
</head>
<body>

    @include('admin.includes.header')

    @include('admin.includes.menu')

    @yield('admin_content')

    @include('admin.includes.loader')

    @include('admin.includes.footer')

<!--    magnific popup-->
<script src="{{asset('/public/admin/plugins/magnific-popup/js/jquery.magnific-popup.min.js')}}"></script>
<!--    Carousel-->
<script src="{{asset('/public/admin/plugins/owl-carosel/js/owl.carousel.min.js')}}"></script>
<!--    Bootstrap-4.3-->
<script src="{{asset('/public/admin/js/popper.min.js')}}"></script>
<script src="{{asset('/public/admin/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/public/admin/js/sub-dropdown.js')}}"></script>
<!--Data table-->
<script src="{{asset('/public/admin/plugins/data-table/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/public/admin/plugins/data-table/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/public/admin/plugins/data-table/js/dataTables.fixedHeader.min.js')}}"></script>
<!--    Theme Script-->
<script src="{{asset('/public/admin/js/script.js')}}"></script>
<!------- START: Toaster ------->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<script>
    @if(Session::has('messege'))
      var type="{{Session::get('alert-type','info')}}"
      switch(type){
          case 'info':
               toastr.info("{{ Session::get('messege') }}");
               break;
          case 'success':
              toastr.success("{{ Session::get('messege') }}");
              break;
          case 'warning':
             toastr.warning("{{ Session::get('messege') }}");
              break;
          case 'error':
              toastr.error("{{ Session::get('messege') }}");
              break;
      }
    @endif
 </script>
 <!-------- END: Toaster -------->

 <!----- START: Sweet-Alert  ----->
<script src="{{ asset('/public/admin/assets/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
<script src="{{ asset('/public/admin/assets/sweetalert2/sweet-alert.init.js')}}"></script>

<script type="text/javascript">
  function deleteItem(id){
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'mr-2 btn btn-danger'
        },
        buttonsStyling: false,
      })
      swalWithBootstrapButtons.fire({
          title: 'Are you sure?',
          text: "You Want to Delete This!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, cancel!',
          reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('delete_form_'+id).submit();
              } else if (
                      // Read more about handling dismissals
                      result.dismiss === Swal.DismissReason.cancel
                  ) {
                      swalWithBootstrapButtons.fire(
                          'Cancelled',
                          'Your Data is Save :)',
                          'error'
                      )
                  }
          })
  }
</script>
 <!----- END: Sweet-Alert  ----->

</body>
</html>
