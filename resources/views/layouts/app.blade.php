<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" type="image/svg+xml" href="{{ setting('logo_url') ?? '' }}" />
    <title>{{ setting('site_title') }} | {{ setting('site_name') }}</title>
    @stack('jsheader')
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
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
            <div class="sidebar-header bg-secondary">
                <h3 class="">
                    <img src="{{ setting('logo_url') ?? '' }}" class="img-circle elevation-1" alt="User Image" style="height: 40px; width: 40px;">
                    <span class="text-white">{{setting('site_title') }}</span>
                </h3>
            </div>

            <ul class="list-unstyled components custom">
                <li class="{{ request()->is('dashboard') | request()->is('/')  ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="dashboard"><i class="material-icons">dashboard</i><span>Dashboard</span></a>
                </li>
                <li class="dropdown {{ request()->is('bukuTamu') ? 'active' : '' }}">
                    <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="material-icons">library_books</i><span>Buku Tamu</span></a>
                    <ul class="collapse list-unstyled menu {{ request()->is('bukuTamu') |  request()->is('listMagang')  ? 'show' : '' }}" id="pageSubmenu2">
                        <li class="{{ request()->is('bukuTamu') ? 'active mt-2 rounded' : '' }}">
                            <a href="{{ route('tamu') }}"> <i class="material-icons">trip_origin</i>Buku Tamu</a>
                        </li>
                        <li class="{{ request()->is('listMagang') ? 'active mt-2 rounded' : '' }}">
                            <a href="{{ route('listmagang') }}"> <i class="material-icons">trip_origin</i>Buku Pkl/Magang</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->is('listbarang') ? 'active' : '' }}">
                    <a href="{{ route('listbarang') }}"><i class="material-icons">inventory_2</i><span>Log Barang/Surat</span></a>
                </li>
                <li class="{{ request()->is('bagian') ? 'active' : '' }}">
                    <a href="{{ route('bagian') }}"><i class="material-icons">lan</i><span>Bagian</span></a>
                </li>
                <li class="{{ request()->is('listworking') ? 'active' : '' }}">
                    <a href="{{ route('listworking') }}"><i class="material-icons">event_repeat</i><span>Working permit</span></a>
                </li>
                <li class="{{ request()->is('profile') ? 'active' : '' }}">
                    <a href="{{ route('profile.edit') }}"><i class="material-icons">manage_accounts</i><span>Profile</span></a>
                </li>
                @role('admin')
                <li class="dropdown | request()->is('users') | request()->is('activity') ? 'active' : '' }}">
                    <a href="#pageprofile" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="material-icons">manage_accounts</i><span>Management Users</span></a>
                    <ul class="collapse list-unstyled menu {{  request()->is('users') | request()->is('activity')  ? 'show' : '' }}" id="pageprofile">


                        <li class="{{ request()->is('users') ? 'active mt-2 rounded' : '' }}">
                            <a href="{{ route('users') }}"><i class="material-icons">trip_origin</i><span>List Users</span></a>
                        </li>

                        <li class="{{ request()->is('activity') ? 'active mt-2 rounded' : '' }}">
                            <a href="{{ route('activity') }}"><i class="material-icons">trip_origin</i><span>Log Activity Users</span></a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->is('settings') ? 'active' : '' }}">
                    <a href="{{ route('settings') }}"><i class="material-icons">settings</i><span>Settings</span></a>
                </li>
                @endrole
                <li class="">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"><i class="material-icons">logout</i><span>Logout</span></a>
                    </form>
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
                        <button class="d-inline-block d-lg-none ml-auto btn btn-white more-button" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                                        @role('admin')
                                        <a class="dropdown-item" href="{{ route('settings') }}">Settings</a>
                                        @endrole
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
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/backend.js')}}"></script>

    @stack('js')
    @stack('before-livewire-scripts')
    <livewire:scripts />
    @stack('after-livewire-scripts')
    @stack('alpine-plugins')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>