<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
      <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Sistem Informasi Manajemen Kesehatan</title>
    <!-- CSS files -->
    <link href="{{asset('./dist/css/tabler.min.css?1684106062')}}" rel="stylesheet"/>
    <link href="{{asset('./dist/css/tabler-flags.min.css?1684106062')}}" rel="stylesheet"/>
    <link href="{{asset('./dist/css/tabler-payments.min.css?1684106062')}}" rel="stylesheet"/>
    <link href="{{asset('./dist/css/tabler-vendors.min.css?1684106062')}}" rel="stylesheet"/>
    <link href="{{asset('./dist/css/demo.min.css?1684106062')}}" rel="stylesheet"/>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
     <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body >
    <script src="{{asset('./dist/js/demo-theme.min.js?1684106062')}}"></script>
    <div class="page">
      <!-- Sidebar -->
      @yield('aside')
        @yield('navbar')
      <div class="page-wrapper">
        <!-- Page content-header -->
         @yield('content-header')
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            @yield('content')
          </div>
        </div>

      </div>
    </div>
    <footer class="footer footer-transparent d-print-none">
          <div class="container-xl">
            <div class="row text-center align-items-center flex-row-reverse">
              <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">
                    Copyright &copy; 2024
                    <a href="." class="link-secondary">Sistem Informasi Manajemen Kesehatan Pegawai</a>.
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
    @yield('script')
    <!-- Libs JS -->
    <script src="{{asset('./dist/libs/apexcharts/dist/apexcharts.min.js?1684106062')}}" defer></script>
    <script src="{{asset('./dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1684106062')}}" defer></script>
    <script src="{{asset('./dist/libs/jsvectormap/dist/maps/world.js?1684106062')}}" defer></script>
    <script src="{{asset('./dist/libs/jsvectormap/dist/maps/world-merc.js?1684106062')}}" defer></script>
    <!-- Tabler Core -->
    <script src="{{asset('./dist/js/tabler.min.js?1684106062')}}" defer></script>
    <script src="{{asset('./dist/js/demo.min.js?1684106062')}}" defer></script>

  </body>
</html>
