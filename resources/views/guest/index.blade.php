@extends('layouts.app')

@section('content')

  <header class="header-banner">
  <div class="container-width">
    <div class="logo-container">
        <img src="{{ url('/images/logo-pemda-prov-bali.png') }}" width="100">
    </div>
    <div class="clearfix">
    </div>
    <center>
    <div class="lead-title">Sistem Informasi Perpustakaan Pemerintah Provinsi Bali
    </center> 
    </div>
    </div>
  </div>
</header>
<section class="flex-sect">
  <div class="container-width">
    <div class="flex-title">Selamat Datang
    </div>
    <div class="flex-desc">Selamat datang di Sistem Informasi Dinas Kearsipan dan Perpustakaan Provinsi Bali
    </div>
  </div>
</section>
<section class="blk-sect">
  <div class="container-width">
    <div class="blk-title">About Us
    </div>
    <div class="blk-desc">Dinas Kearsipan dan Perpustakaan Provinsi Bali
    </div>
    <div class="blk-desc">Jl. D.I Panjaitan No.4 Niti Mandala Renon Denpasar
    </div>
    <div class="blk-desc">(0361) 223201
    </div>
  </div>
</section>
<footer class="footer-under">
  <div class="container-width">
  </div>
  <div class="copyright">
    <div class="container-width">
      <div class="made-with">
        Dinas Kearsipan dan Perpustakaan Provinsi Bali
      </div>
      <div class="foot-social-btns">facebook twitter linkedin mail
      </div>
      <div class="clearfix">
      </div>
    </div>
  </div>
</footer>
@endsection

@section('scripts')
  {!! $html->scripts() !!}
@endsection

