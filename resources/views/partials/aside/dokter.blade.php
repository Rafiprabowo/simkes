<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark">
            SIMKES
          </h1>
<div class="collapse navbar-collapse" id="sidebar-menu">
    <ul class="navbar-nav pt-lg-3">
        <li class="nav-item">
                <a class="nav-link" href="/dokter/" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Dashboard
                  </span>
                </a>
              </li>
        <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/lifebuoy -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M15 15l3.35 3.35" /><path d="M9 15l-3.35 3.35" /><path d="M5.65 5.65l3.35 3.35" /><path d="M18.35 5.65l-3.35 3.35" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Medical Check Up
                  </span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{route('medical-check-up.create')}}" >
                    Buat MCU
                  </a>
                    <a class="dropdown-item" href="{{route('medical-check-up.index')}}" >
                    Hasil MCU
                  </a>

                </div>
              </li>
        <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/lifebuoy -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M15 15l3.35 3.35" /><path d="M9 15l-3.35 3.35" /><path d="M5.65 5.65l3.35 3.35" /><path d="M18.35 5.65l-3.35 3.35" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Janji Temu
                  </span>
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{route('appointments.index')}}">
                    Lihat Janji Temu
                  </a>

                </div>
              </li>
        <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/lifebuoy -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M15 15l3.35 3.35" /><path d="M9 15l-3.35 3.35" /><path d="M5.65 5.65l3.35 3.35" /><path d="M18.35 5.65l-3.35 3.35" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Diagnosa
                  </span>
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{route('diagnosa.create')}}">
                    Buat Diagnosa
                  </a>
                  <a class="dropdown-item" href="{{route('diagnosa.index')}}">
                    Hasil Diagnosa
                  </a>
                </div>
              </li>
        <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" /><path d="M12 12l8 -4.5" /><path d="M12 12l0 9" /><path d="M12 12l-8 -4.5" /><path d="M16 5.25l-8 4.5" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Profil & Keluar
                  </span>
                </a>
                <div class="dropdown-menu">
                  <div class="dropdown-menu-columns">
                    <div class="dropdown-menu-column">
                      <a class="dropdown-item" href="/dokter/profile">
                        Lihat Profil
                      </a>
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item">
                            Keluar
                        </button>
                        </form>

                    </div>
                  </div>
                </div>
              </li>
    </ul>
</div>
</div>
</aside>
