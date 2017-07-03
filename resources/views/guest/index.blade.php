@extends('layouts.app')

@section('content')

  <header class="header-banner">
  <div class="container-width">
    <div class="logo-container">
        <img src="/images/logo-pemda-prov-bali.jpg" width="100">
    </div>
    <div class="clearfix">
    </div>
    <div class="lead-title">Sistem Informasi Perpustakaan
    </div>
    <div class="sub-lead-title">Sistem informasi ini....
    </div>
  </div>
</header>
<section class="flex-sect">
  <div class="container-width">
    <div class="flex-title">Sambutan
    </div>
    <div class="flex-desc">Sambutan
    </div>
  </div>
</section>
<section class="blk-sect">
  <div class="container-width">
    <div class="blk-title">About Us
    </div>
    <div class="blk-desc">About Us
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

