<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" type="image/svg+xml" href="/icon.svg" />
    <title>{{ setting('site_title') }} | {{ setting('site_name') }}</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/custom.css">
    @stack('styles')
    <livewire:styles />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <div class="body-overlay"></div>
        <nav id="sidebar" class="shadow-sm">
            <div class="sidebar-header">
                <h3 class="text-info"><img src="https://ui-avatars.com/api/?rounded=true&background=5F9DF7&color=fff&name={{setting('site_title') }}" class="img-fluid" /><span>{{setting('site_title') }}</span></h3>
            </div>
            <ul class="list-unstyled components">
                <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="dashboard"><i class="material-icons">dashboard</i><span>Dashboard</span></a>
                </li>
                <li class="dropdown {{ request()->is('bukuTamu') ? 'active' : '' }}">
                    <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="material-icons">library_books</i><span>Buku Tamu</span></a>
                    <ul class="collapse list-unstyled menu {{ request()->is('bukuTamu') ? 'show' : '' }}" id="pageSubmenu2">
                        <li class="{{ request()->is('bukuTamu') ? 'active mt-2 rounded' : '' }}">
                            <a href="{{ route('tamu') }}"> <i class="material-icons">trip_origin</i>Buku Tamu</a>
                        </li>
                        <li>
                            <a href="#"> <i class="material-icons">trip_origin</i>Buku Pkl/Magang</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->is('tamu') ? 'active' : '' }}">
                    <a href="{{ route('tamu') }}"><i class="material-icons">inventory_2</i><span>Log Barang/Surat</span></a>
                </li>
                <li class="{{ request()->is('bagian') ? 'active' : '' }}">
                    <a href="{{ route('bagian') }}"><i class="material-icons">lan</i><span>Bagian</span></a>
                </li>
                <li class="{{ request()->is('tamu') ? 'active' : '' }}">
                    <a href=""><i class="material-icons">event_repeat</i><span>Working permit</span></a>
                </li>
                <li class="dropdown {{ request()->is('profile') | request()->is('users') | request()->is('activity') ? 'active' : '' }}">
                    <a href="#pageprofile" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="material-icons">manage_accounts</i><span>User</span></a>
                    <ul class="collapse list-unstyled menu {{ request()->is('profile') | request()->is('users') | request()->is('activity')  ? 'show' : '' }}" id="pageprofile">
                        <li class="{{ request()->is('profile') ? 'active mt-2 rounded' : '' }}">
                            <a href="{{ route('profile.edit') }}"><i class="material-icons">trip_origin</i><span>Profile</span></a>
                        </li>

                        <li class="{{ request()->is('users') ? 'active mt-2 rounded' : '' }}">
                            <a href="{{ route('users') }}"><i class="material-icons">trip_origin</i><span>Management Users</span></a>
                        </li>

                        <li class="{{ request()->is('activity') ? 'active mt-2 rounded' : '' }}">
                            <a href="{{ route('activity') }}"><i class="material-icons">trip_origin</i><span>Log Activity Users</span></a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->is('settings') ? 'active' : '' }}">
                    <a href="{{ route('settings') }}"><i class="material-icons">settings</i><span>Settings</span></a>
                </li>
            </ul>
        </nav>
        <div id="content">

            <div class="top-navbar bg-white">
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid ">
                        <button type="button" id="sidebarCollapse" class="d-xl-block d-lg-block d-md-mone d-none text-dark">
                            <span class="material-icons">menu</span>
                        </button>
                        <a class="navbar-brand  a-nav" href="#">{{ setting('site_name') }}</a>
                        <button class="d-inline-block d-lg-none ml-auto btn btn-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="material-icons">more_vert</span>
                        </button>
                        <div class="collapse navbar-collapse d-lg-block d-xl-block d-sm-none d-md-none d-none" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto ">
                                <li class="nav-item dropdown ">
                                    <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="{{ auth()->user()->avatar_url }}" id="profileImage" class="img-circle elevation-1" alt="User Image" style="height: 30px; width: 30px;">
                                        <span class="ml-2 mr-3" x-ref="username">{{ auth()->user()->name }}</span>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('profile.edit') }}" x-ref="profileLink">Profile</a>
                                        <a class="dropdown-item" href="{{ route('profile.edit') }}" x-ref="changePasswordLink">Change Password</a>
                                        <a class="dropdown-item" href="{{ route('settings') }}">Settings</a>
                                        <div class="dropdown-divider"></div>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="main-content">
                {{ $slot }}
            </div>
        </div>
    </div>
    <script src="/js/app.js"></script>
    <script src="/js/backend.js"></script>
    @stack('js')
    @stack('before-livewire-scripts')
    <livewire:scripts />
    @stack('after-livewire-scripts')
    @stack('alpine-plugins')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>