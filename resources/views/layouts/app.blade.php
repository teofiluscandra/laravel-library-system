<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ url('/css/font-awesome.min.css') }}" rel='stylesheet' type='text/css'> 
    <link href="{{ url('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('/css/app.css') }}" rel="stylesheet">
    <link href="{{ url('/css/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ url('/css/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ url('/css/selectize.css') }}" rel="stylesheet">
    <link href="{{ url('/css/selectize.bootstrap3.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!--Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if (Auth::check())
                        {!! Html::smartNav(url('/home'), 'Dashboard') !!}
                    @endif
                    @role('kepala')
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Laporan
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                            <li><a href="{{ route('export.borrow') }}">Peminjaman</a></li>
                            <li><a href=" {{route('export.members')}}">Member</a></li>
                            <li><a href=" {{route('export.staff')}}">Staff</a></li>
                            <li><a href=" {{route('export.books')}}">Buku</a></li>
                            </ul>
                        </li>
                    @endrole
                    @role('admin')
                       
                        
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">User
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                            <li><a href="{{ route('staff.index') }}">Staff</a></li>
                            <li><a href=" {{route('members.index')}}">Member</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Buku
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                            <li><a href="{{ route('authors.index') }}">Penulis</a></li>
                            <li><a href="{{ route('categories.index') }}">Kategori</a></li>
                            <li><a href=" {{route('books.index')}}">Daftar Buku</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Laporan
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                            <li><a href="{{ route('export.borrow') }}">Peminjaman</a></li>
                            <li><a href=" {{route('export.members')}}">Member</a></li>
                            <li><a href=" {{route('export.staff')}}">Staff</a></li>
                            <li><a href=" {{route('export.books')}}">Buku</a></li>
                            </ul>
                        </li>
                        
                        {!! Html::smartNav(route('statistics.index'), 'Peminjaman') !!}
                        
                        {!! Html::smartNav(url('data/settings/library'), 'Setting') !!}
                    @endrole
                    @role('member')
                        {!! Html::smartNav(route('booklist.index'), 'Daftar Buku') !!}
                        {!! Html::smartNav(url('/settings/profile'), 'Profil') !!}
                    @endrole
                    @role('staff')
                       {!! Html::smartNav(route('authors.index'), 'Penulis') !!}
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Buku
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                            <li><a href="{{ route('categories.index') }}">Kategori</a></li>
                            <li><a href=" {{route('books.index')}}">Daftar Buku</a></li>
                            </ul>
                        </li>
                        {!! Html::smartNav(route('members.index'), 'Member') !!}
                        {!! Html::smartNav(route('statistics.index'), 'Peminjaman') !!}
                        {!! Html::smartNav(url('/settings/profile'), 'Profil') !!}
                        {!! Html::smartNav(url('data/settings/library'), 'Setting') !!}
                    @endrole
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Daftar</a></li>
                         <li><a href="{{ url('/books-list') }}">Daftar Buku</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">

                                <li><a href="{{ url('/settings/password') }}"><i class="fa fa-btn fa-lock"></i> Ubah Password</a></li>
                                <li>
                                    <a href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @include('layouts._flash')

    @yield('content')

    <!-- Scripts -->
    <script src="{{ url('/js/jquery-3.1.0.min.js') }}"></script>
    <script src="{{ url('/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ url('/js/selectize.min.js') }}"></script>
    <script src="{{ url('/js/custom.js') }}"></script>
    @yield('scripts')
</body>
</html>
