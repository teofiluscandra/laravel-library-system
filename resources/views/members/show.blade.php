@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="{{ url('/data/members') }}">Member</a></li>
          <li class="active">Detail {{ $member->name }}</li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Detail {{ $member->name }}</h2>
          </div>

          <div class="panel-body">
            <table class="table">
              <tbody>
              <tr>
                  <td class="text-muted">Kode Member</td>
                  <td>{{ $member->members->kode_member }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Nama</td>
                  <td>{{ $member->name }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Email</td>
                  <td>{{ $member->email }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Login terakhir</td>
                  <td>{{ $member->last_login }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Jenis Kelamin</td>
                  <td>{{ $member->members->jenis_kelamin }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Tempat Lahir</td>
                  <td>{{ $member->members->tempat_lahir }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Tanggal Lahir</td>
                  <td>{{ date("d-m-Y", strtotime($member->members->tanggal_lahir)) }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Nomor Identitas</td>
                  <td>{{ $member->members->no_identitas }}</td>
                </tr>
                <tr>
                  <td class="text-muted">Alamat</td>
                  <td>{{ $member->members->alamat }}</td>
                </tr>
                
              </tbody>
            </table>
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Detail Peminjaman {{ $member->name }}</h2>
          </div>

          <div class="panel-body">
            <p>Buku yang sedang dipinjam:</p>
            <table class="table table-condensed table-striped">
              <thead>
                <tr>
                  <td>Judul</td>
                  <td>Tanggal Peminjaman</td>
                </tr>
              </thead>
              <tbody>
                @forelse ($member->borrowLogs()->borrowed()->get() as $log)
                  <tr>
                    <td>{{ $log->nomor_peminjaman }}</td>
                    <td>{{ $log->created_at }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="2">Tidak ada data</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
            <p>Buku yang telah dikembalikan:</p>
            <table class="table table-condensed table-striped">
              <thead>
                <tr>
                  <td>Nomor Peminjaman</td>
                  <td>Tanggal Kembali</td>
                </tr>
              </thead>
              <tbody>
                @forelse ($member->borrowLogs()->returned()->get() as $log)
                  <tr>
                    <td>{{ $log->nomor_peminjaman }}</td>
                    <td>{{ $log->updated_at }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="2">Tidak ada data</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

