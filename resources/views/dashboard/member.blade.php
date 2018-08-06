@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2 class="panel-title">Dashboard</h2>
          </div>

          <div class="panel-body">
            Selamat datang di Sistem Informasi Perpustakaan.
            <h4>Data Peminjaman</h4>
            <table class="table">
                <tbody>
                    <tr>
                        
                        <td>
                            @if ($borrowLogs->count() == 0)
                                Tidak ada buku dipinjam
                            @endif

                            <table class="table table-condensed">
                              <thead>
                                  <tr>
                                    <th>Nomor Peminjaman</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Jumlah Hari</th>
                                    <th>Jumlah Buku</th>
                                  </tr>
                              </thead>


                            @foreach ($borrowLogs as $borrowLog)
                               <tr>
                                 <td>{{ $borrowLog->nomor_peminjaman }}</td>
                                 <td>{{ $borrowLog->tanggal_pinjam }}</td>
                                 <td>{{ $borrowLog->getDays($borrowLog->tanggal_pinjam) }} Hari</td>
                                 <td>{{ $borrowLog->details->count() }}</td>
                               </tr> 
                            @endforeach

                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

