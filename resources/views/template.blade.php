<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Akademik SMA Bakti Idhata</title>

    {{-- Memanggil Bootstrap. Komentar ini tidak akan tampak di browser. --}}
    <link href="{{ asset('bootstrap_3_3_6/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="{{ asset('http://wabi.com/js/html5shiv_3_7_2.min.js') }}"></script>
      <script src="{{ asset('http://wabi.com/js/respond_1_4_2.min.js') }}"></script>
    <![endif]-->
  </head>
  <body>
    <div class="containers">
      @include('navbar')
      @yield('main')
    </div>

    @yield('footer')

    <script src="{{ asset('js/jquery_2_2_1.min.js') }}"></script>
    <script src="{{ asset('bootstrap_3_3_6/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/laravelapp.js') }}"></script>
  </body>
</html>