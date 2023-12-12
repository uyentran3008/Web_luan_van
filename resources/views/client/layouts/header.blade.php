<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        @yield('title','KOPPEE - Coffee Shop HTML Template')
      </title>
    
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{  asset('client/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    {{-- <link href="{{asset('client/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" /> --}}

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('client/css/style.min.css') }}" rel="stylesheet">
    <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('client/lib/easing/easing.min.js') }}"></script>
    {{-- <script src="{{ asset('client/lib/waypoints/waypoints.min.js') }}"></script> --}}
    <script src="{{ asset('client/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('client/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('client/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('client/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('client/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('client/mail/contact.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js" integrity="sha512-WFN04846sdKMIP5LKNphMaWzU7YpMyCU245etK3g/2ARYbPK9Ub18eG+ljU96qKRCWh+quCY7yefSmlkQw1ANQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('admin/assets/base/base.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    {{-- <script src="{{ asset('client/js/main.js') }}"></script> --}}
    <!-- Template Javascript -->
    <script src="{{ asset('client/js/main.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script> --}}
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    @yield('scripts')
    
@include('client.layouts.navbar')
<!-- Navbar End -->

<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5">
    <div id="blog-carousel" class="carousel slide overlay-bottom" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="{{ asset('img/carousel-1.jpg') }}" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <h2 class="text-primary font-weight-medium m-0">We Have Been Serving</h2>
                    <h1 class="display-1 text-white m-0">COFFEE</h1>
                    <h2 class="text-white m-0">* SINCE 2023 *</h2>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="{{ asset('img/carousel-2.jpg') }}" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <h2 class="text-primary font-weight-medium m-0">We Have Been Serving</h2>
                    <h1 class="display-1 text-white m-0">COFFEE</h1>
                    <h2 class="text-white m-0">* SINCE 2023 *</h2>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#blog-carousel" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#blog-carousel" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
</div>