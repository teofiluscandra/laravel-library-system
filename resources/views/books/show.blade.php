@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/books-list') }}">Daftar Buku</a></li>
          <li class="active">Detail Buku</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Detail Buku</h2>
          </div>

          <div class="panel-body">
            <table class="table">
              <tbody>
              <tr>
                  <td class="text-muted">Cover</td>
                  <td><img src="/img/{{ $book->cover }}"></td>
                </tr>
              <tr>
                  <td class="text-muted">Kode Buku</td>
                  <td>{{ $book->kode_buku }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Judul Buku</td>
                  <td>{{ $book->title }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Pengarang</td>
                  <td>{{ $book->author->name }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Tahun Terbit</td>
                  <td>{{ $book->tahun_terbit }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Penerbit</td>
                  <td>{{ $book->penerbit }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Stok Buku</td>
                  <td>{{ $book->stock }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

