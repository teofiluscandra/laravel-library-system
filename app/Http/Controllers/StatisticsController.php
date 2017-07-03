<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Facades\Datatables;
use App\BorrowLog;

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
                        return $stat->updated_at;
                    }
                    return "Masih dipinjam";
                })
                ->addColumn('nomor_peminjaman', function($stat) {
                    return '<a href="'.route('borrow.show', $stat->id).'">'.$stat->nomor_peminjaman.'</a>';
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
            ->addColumn(['data' => 'created_at', 'name'=>'created_at', 'title'=>'Tanggal Pinjam', 'searchable'=>false])
            ->addColumn(['data' => 'returned_at', 'name'=>'returned_at', 'title'=>'Tanggal Kembali',
                'orderable'=>false, 'searchable'=>false])
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'Action',
                'orderable'=>false, 'searchable'=>false]);
        return view('statistics.index')->with(compact('html'));
    }
}
