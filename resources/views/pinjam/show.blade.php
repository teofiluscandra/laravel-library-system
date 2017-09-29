@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/data/statistics') }}">Peminjaman</a></li>
          <li class="active">Histori Peminjaman</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Data Peminjaman</h2>
          </div>

          <div class="panel-body">
              <table class="table">
              <tbody>
              <tr>
                  <td class="text-muted">Nomor Peminjaman</td>
                  <td>{{ $borrow->nomor_peminjaman }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Nama Peminjam</td>
                  <td>{{ $borrow->user->name }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Tanggal Peminjaman</td>
                  <td>{{ date("d-m-Y", strtotime($borrow->tanggal_pinjam)) }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Total Buku</td>
                  <td>{{ $borrow->details->count() }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Nama Staff Yang Bertugas</td>
                  <td>{{ $borrow->adminAssigned->name }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Status</td>
                  <td>{{ ($borrow->is_borrowed) ? "Sudah di kembalikan" : "Masih di pinjam" }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Jumlah Hari</td>
                  <td>{{ $borrow->getDays($borrow->tanggal_pinjam) }} Hari</td>
                </tr>
                <tr>
                  <td class="text-muted">Keterlambatan</td>
                  <td>{{ ($keterlambatan == 0) ? "Tidak ada Keterlambatan" : $keterlambatan . ' Hari' }} </td>
                </tr>
                <tr>
                  <td class="text-muted">Denda</td>
                  <td>{{ ($denda == 0) ? "Tidak ada denda" : $denda }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Data Buku</h2>
          </div>

          <div class="panel-body">
              <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
                <thead>
                    <th>Nomor</th>
                    <th>Kode Buku</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                </thead>
                <tbody>
                    @foreach($borrow->details as $borrow_detail) 
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{!!$borrow_detail->book->kode_buku!!}</td>
                        <td>{!!$borrow_detail->book->title!!}</td>
                        <td>{!!$borrow_detail->book->author->name!!}</td>
                        <td>{!!$borrow_detail->book->penerbit!!}</td>
                    </tr>
                    @php
                      $no++
                    @endphp
                    @endforeach 
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

