<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Facades\Datatables;
use App\BorrowLog;
use App\LibrarySetting;

class StatisticsController extends Controller
{
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $stats = BorrowLog::with('user');
            if ($request->get('status') == 'returned') $stats->returned();
            if ($request->get('status') == 'not-returned') $stats->borrowed();

            return Datatables::of($stats)
                ->addColumn('returned_at', function($stat){
                    if ($stat->is_returned) {
                        return date('d-m-Y', strtotime($stat->updated_at));
                    }
                    $days = LibrarySetting::first();
                    return date('d-m-Y', strtotime($stat->tanggal_pinjam. "+". $days->maksimal_hari . "days"));
                })
                ->addColumn('created_at', function($stat){
                    
                    return date('d-m-Y', strtotime($stat->tanggal_pinjam));
                })
                ->addColumn('nomor_peminjaman', function($stat) {
                    return '<a href="'.route('borrow.show', $stat->id).'">'.$stat->nomor_peminjaman.'</a>';
                })
                ->addColumn('jumlah_hari', function($stat) {
                    if ($stat->is_returned) {
                        return '';
                    }
                    if($stat->getDays($stat->tanggal_pinjam) > 14){
                        return '<h4><span class="label label-danger">'.$stat->getDays($stat->tanggal_pinjam).' Hari</span></h4>';
                    }
                    else {
                        return $stat->getDays($stat->tanggal_pinjam). ' Hari';
                    }
                })
                ->addColumn('action', function($stat){
                    if ($stat->is_returned) {
                        return '';
                    }
                    return view('datatable._return', [
                        'return_url' => 'borrow/'.$stat->id.'/return'
                    ]);
                })->make(true);
        }

        $html = $htmlBuilder
            ->addColumn(['data' => 'nomor_peminjaman', 'name'=>'nomor_peminjaman', 'title'=>'Nomor Peminjaman'])
            ->addColumn(['data' => 'user.name', 'name'=>'user.name', 'title'=>'Peminjam'])
            ->addColumn(['data' => 'jumlah_hari', 'name'=>'jumlah_hari', 'title'=>'Jumlah Hari', 'searchable'=>false])
            ->addColumn(['data' => 'created_at', 'name'=>'created_at', 'title'=>'Tanggal Pinjam', 'searchable'=>false])
            ->addColumn(['data' => 'returned_at', 'name'=>'returned_at', 'title'=>'Tanggal Kembali',
                'orderable'=>false, 'searchable'=>false])
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'Action',
                'orderable'=>false, 'searchable'=>false]);
        return view('statistics.index')->with(compact('html'));
    }
}
