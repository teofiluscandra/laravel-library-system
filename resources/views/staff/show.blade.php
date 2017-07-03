@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/data/staff') }}">Staff</a></li>
          <li class="active">Detail {{ $user->name }}</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Detail {{ $user->name }}</h2>
          </div>

          <div class="panel-body">
            <table class="table">
              <tbody>
              <tr>
                  <td class="text-muted">NIP</td>
                  <td>{{ $user->staff->nip }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Nama</td>
                  <td>{{ $user->name }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Email</td>
                  <td>{{ $user->email }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Login terakhir</td>
                  <td>{{ $user->last_login }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Jenis Kelamin</td>
                  <td>{{ $user->staff->jenis_kelamin }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Nomor Telepon</td>
                  <td>{{ $user->staff->telp }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Alamat</td>
                  <td>{{ $user->staff->alamat }}</td>
                </tr>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

