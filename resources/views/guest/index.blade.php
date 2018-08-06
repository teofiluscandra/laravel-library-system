@extends('layouts.app')

@section('content')

  <header class="header-banner">
  <div class="container-width">
    <div class="logo-container">
        
    </div>
    <div class="clearfix">
    </div>
    <center>
    <div class="lead-title">Sistem Informasi Perpustakaan
    </center> 
    </div>
    </div>
  </div>
</header>
<section class="flex-sect">
  <div class="container-width">
    <div class="flex-title">Selamat Datang
    </div>
    <div class="flex-desc">Selamat datang di Sistem Informasi Perpustakaan
    </div>
    <p>This system is build with Laravel Framework, for improve my coding with PHP</p>
    <p>Feature : </p>
    <ol>
      <li>User Management (Admin, Member and Library Staff)</li>
      <li>Books data management with category</li>
      <li>Reporting</li>
      <li>Borrow management with maximal date and late penalty</li>
    </ol>
  </div>
</section>

@endsection

@section('scripts')
  {!! $html->scripts() !!}
@endsection

