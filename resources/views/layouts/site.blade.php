<!DOCTYPE html>
<html>
<head>
  <title>ChirosConnect:Homepage</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="{{ url('/') }}/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="{{ url('/') }}/css/style.css">
  <link rel="stylesheet" type="text/css" href="{{ url('/') }}/swiper/css/swiper.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

  <script type="text/javascript" src="{{ url('/') }}/js/jquery.min.js"></script>
  <script type="text/javascript" src="{{ url('/') }}/js/popper.min.js"></script>
  <script type="text/javascript" src="{{ url('/') }}/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="{{ url('/') }}/swiper/js/swiper.min.js"></script>
  <script type="text/javascript" src="{{ url('/') }}/swiper/js/swiper.esm.js"></script>
  <script type="text/javascript" src="{{ url('/') }}/swiper/js/swiper.min.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>

  <style>
  label.error{ color: red; font-style: italic; font-size: 12px !important; float: left; }
  </style>

</head>
<body class="home">
  <main class="main-wrapper">

    @component('components.site-header')
    @endcomponent

    @yield('content')

    @component('components.site-footer')
    @endcomponent
    
  </main>
  
   <script>
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 3,
      spaceBetween: 30,
      slidesPerGroup: 3,
      loop: true,
      loopFillGroupWithBlank: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        640: {
          slidesPerView: 1,
          spaceBetween: 0,
        }
      }
    });

        setTimeout(function(){ 
            $('.alert.alert-danger, .alert.alert-success').fadeOut('slow');
        }, 3000);

  </script>
</body>
</html>