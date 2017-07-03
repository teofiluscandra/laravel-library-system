@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/data/statistics') }}">Peminjaman</a></li>
          <li class="active">Pengembalian Buku</li>
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
                  <td>{{ $return->nomor_peminjaman }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Nama Peminjam</td>
                  <td>{{ $return->user->name }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Tanggal Peminjaman</td>
                  <td>{{ date("d-m-Y", strtotime($return->tanggal_pinjam)) }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Total Buku</td>
                  <td>{{ $return->details->count() }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Nama Staff Yang Bertugas</td>
                  <td>{{ $return->adminAssigned->name }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Status</td>
                  <td>{{ ($return->is_returned) ? "Sudah di kembalikan" : "Masih di pinjam" }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Jumlah Hari</td>
                  <td>{{ $hari }} Hari</td>
                </tr>
                <tr>
                  <td class="text-muted">Keterlambatan</td>
                  <td>{{ ($keterlambatan == 0) ? "Tidak ada Keterlambatan" : $keterlambatan }}</td>
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
                    @foreach($return->details as $borrow_detail) 
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

            {!! Form::model($return, ['url' => route('borrow.return.post', $return->id),
              'method'=>'put', 'class' => 'form-horizontal js-confirm', 'data-confirm' => 'Yakin untuk simpan pengembalian buku?']) !!}
            @include('return._form')
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

