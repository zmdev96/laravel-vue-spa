@php
$config = [
  'appName' => config('app.name'),
  'local'   => $local = app()->getLocale(),
  'appUrl'  => config('app.url'),
];
@endphp
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Amal Blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300, 400,700|Inconsolata:400,700" rel="stylesheet">

    <link rel="stylesheet" href="/assets/front/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/front/css/animate.css">
    <link rel="stylesheet" href="/assets/front/css/owl.carousel.min.css">

    <link rel="stylesheet" href="/assets/front/fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="/assets/front/fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/front/fonts/flaticon/font/flaticon.css">

    <!-- Theme Style -->
    <link rel="stylesheet" href="/assets/front/css/style.css">
    <link rel="stylesheet" href="/assets/front/css/main.css">

  </head>
  <body>

    <div id="app">
      <layout-app> </layout-app>
    </div>
     <script src="/assets/front/js/jquery-3.2.1.min.js"></script>
     <script src="/assets/front/js/jquery-migrate-3.0.0.js"></script>
     <script src="/assets/front/js/popper.min.js"></script>
     <script src="/assets/front/js/bootstrap.min.js"></script>
     <script src="/assets/front/js/owl.carousel.min.js"></script>
     <script src="/assets/front/js/jquery.waypoints.min.js"></script>
     <script src="/assets/front/js/jquery.stellar.min.js"></script>
     <script src="/assets/front/js/main.js"></script>
     <script>
       window.config = @json($config);
     </script>

     <script src="{{asset('assets/front/vue/js/app.js')}}" charset="utf-8"></script>
     <script src="https://unpkg.com/vue-meta/dist/vue-meta.min.js"></script>
     <script src="/assets/front/vendor/birthday_selector/dobpicker.js"></script>
     <script type="text/javascript">

       $.dobPicker({
         // Selectopr IDs
         daySelector:'#dobday',
         monthSelector:'#dobmonth',
         yearSelector:'#dobyear',
         // Default option values
         dayDefault:'Day',
         monthDefault:'Month',
         yearDefault:'Year',
         // Minimum age
         minimumAge: 16,
         // Maximum age
         maximumAge: 100

       });


     </script>

  </body>
</html>
