<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Login</title>
    <!-- CSS files -->
    <link href="{{asset('./dist/css/tabler.min.css?1684106062')}}" rel="stylesheet"/>
    <link href="{{asset('./dist/css/tabler-flags.min.css?1684106062')}}" rel="stylesheet"/>
    <link href="{{asset('./dist/css/tabler-payments.min.css?1684106062')}}" rel="stylesheet"/>
    <link href="{{asset('./dist/css/tabler-vendors.min.css?1684106062')}}" rel="stylesheet"/>
    <link href="{{asset('./dist/css/demo.min.css?1684106062')}}" rel="stylesheet"/>
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
  <body  class=" d-flex flex-column">
    <script src="{{asset('./dist/js/demo-theme.min.js?1684106062')}}"></script>
    <div class="page page-center">
      <div class="container container-tight py-4">
          @if(session('error'))
        <div class="alert alert-danger" role="alert">
  <h4 class="alert-title">{{session('error')}}</h4>
</div>
        @endif

              <div class="text-center mb-4">
                  <h3>Sistem Informasi Kesehatan Pegawai</h3>
              </div>
        <div class="card card-md">
          <div class="card-body">
            <h2 class="h2 text-center mb-4">Halaman login</h2>
            <form action="/login" method="post" autocomplete="off" novalidate>
                @csrf
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="your@email.com" autocomplete="off">
                 @error('email')
                              <div class="invalid-feedback">{{$message}}</div>
                              @enderror
              </div>
              <div class="mb-2">
                <label class="form-label">
                  Password
                </label>
                <div class="input-group input-group-flat">
                  <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"  placeholder="Your password"  autocomplete="off">
                  <span class="input-group-text">
                    <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                    </a>
                  </span>
                     @error('password')
                              <div class="invalid-feedback">{{$message}}</div>
                              @enderror
                </div>
              </div>
              <div class="mb-2">
              </div>
              <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{asset('./dist/js/tabler.min.js?1684106062')}}" defer></script>
    <script src="{{asset('./dist/js/demo.min.js?1684106062')}}" defer></script>
  </body>
</html>
