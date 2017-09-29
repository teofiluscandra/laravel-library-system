<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BorrowLog;
use App\Book;
use App\Borrow_detail;
use App\LibrarySetting;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;
use Excel;
use PDF;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lastID = (BorrowLog::max('id')) + 1;
        if($lastID){
            $id = 'P-'. $lastID; 
        } else {
            $id = 'P-0'; 
        }
        
        return view('pinjam.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nomor_peminjaman' => 'required|unique:borrow_logs',
            'user_id' => 'required'
        ]);

        DB::beginTransaction();

        $returned = BorrowLog::where('user_id', $request->user_id)->where('is_returned',0)->first();

        if(isset($returned)) {
            Session::flash("flash_notification", [
            "level"   => "warning",
            "message" => "Member sedang meminjam buku"
            ]);

        return redirect()->route('statistics.index');
        }

        $borrow_data = $request->only('nomor_peminjaman','user_id');
        $borrow_data['staff_id'] = auth()->user()->id;
        $borrow_data['is_returned'] = 0;
        $borrow_data['tanggal_pinjam'] = date("Y-m-d");
        $borrow = BorrowLog::create($borrow_data);

        $check = 0;
        foreach($request->books as $book){
            if($book){
                $books = Book::find($book);
                
                if($books->stock <= 0){
                    Session::flash("flash_notification", [
                        "level"   => "danger",
                        "message" => "Stock Buku ". $books->title ." Habis"
                    ]);
                    return back();
                }
                $books->stock = ($books->stock) - 1;
                $books->update();
                $borrow_detail = new Borrow_detail();
                $borrow_detail->borrow_id = $borrow->id;
                $borrow_detail->book_id = $book;
                $borrow_detail->save();
                $check++;
            }
        }

        if($check == 0){
            Session::flash("flash_notification", [
                "level"   => "danger",
                "message" => "Data Buku Harus diisi"
            ]);

            return redirect()->route('statistics.index');
        }
        
        DB::commit();
        Session::flash("flash_notification", [
            "level"   => "success",
            "message" => "Berhasil menyimpan data peminjaman "
        ]);

        return redirect()->route('statistics.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $borrow = BorrowLog::findOrFail($id);
        $no = 1;
        $hari = $borrow->getDays($borrow->tanggal_pinjam);
        if($hari > $borrow->getMaximumDays()){
            $keterlambatan = $hari - $borrow->getMaximumDays();
            $denda = $keterlambatan * $borrow->getDenda();
        } else {
            $denda = 0;
            $keterlambatan = 0;
        }
        return view('pinjam.show', compact('borrow','no','denda','keterlambatan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function return($id){
        $return = BorrowLog::findOrFail($id);
        $no = 1;
        $hari = $return->getDays($return->tanggal_pinjam);
        if($hari > $return->getMaximumDays()){
            $keterlambatan = $hari - $return->getMaximumDays();
            $denda = $keterlambatan * $return->getDenda() * $return->details->count();
        } else {
            $denda = 0;
            $keterlambatan = 0;
        }

        return view('return.create', compact('return','no', 'hari', 'denda','keterlambatan'));
    }

    public function return_post(Request $request, $id){
        $return = BorrowLog::findOrFail($id);
        $data['tanggal_kembali'] = date('Y-m-d');
        $hari = $return->getDays($return->tanggal_pinjam);
        if($hari > $return->getMaximumDays()){
            $data['keterlambatan'] = $hari - $return->getMaximumDays();
            $data['denda'] = $data['keterlambatan'] * $return->getDenda() * $return->details->count();
        } else {
            $data['keterlambatan'] = 0;
            $data['denda'] = 0;
        }

        $data['is_returned'] = 1;
        $borrow = $return->update($data);

        foreach($return->details as $book){
            if($book){
                $books = Book::find($book->book_id);
                $books->stock = ($books->stock) + 1;
                $books->update();
            }
        }

        if($hari > $return->getMaximumDays()){
            $setting = LibrarySetting::first();
            $pdf = PDF::loadview('pdf.slip', compact('return','setting'));
            return $pdf->stream();
        } else {
            return redirect()->route('statistics.index');
        }
    }

        public function export() 
    { 
        return view('pinjam.export');
    }

    public function exportPostAll(Request $request) 
    { 
        // validasi
        $this->validate($request, [
            'type'=>'required|in:pdf,xls'
        ]);

        $borrows = BorrowLog::get();

        $handler = 'export' . ucfirst($request->get('type'));
        return $this->$handler($borrows);
    }

    public function exportPost(Request $request) 
    { 
        // validasi
        $this->validate($request, [
            'start_date' => 'required',
            'end_date' => 'required', 
            'type'=>'required|in:pdf,xls'
        ]);

        $borrows = BorrowLog::whereBetween('tanggal_pinjam', [$request->start_date, $request->end_date])->get();

        $handler = 'export' . ucfirst($request->get('type'));
        return $this->$handler($borrows);
    }

    private function exportXls($borrows)
    {
        Excel::create('Data Peminjaman Perpustakaan', function($excel) use ($borrows) {
            // Set the properties
            $excel->setTitle('Data Peminjaman Perpustakaan')
                ->setCreator(Auth::user()->name);

            $excel->sheet('Data Peminjaman', function($sheet) use ($borrows) {
                $row = 1;
                $sheet->row($row, [
                    'Nomor Peminjaman',
                    'Nama',
                    'Tanggal',
                    'Total Buku',
                    'Staff',
                    'Status',
                    'Jumlah Hari',
                    'Keterlambatan',
                    'Denda'
                ]);
                foreach ($borrows as $borrow) {
                    $sheet->row(++$row, [
                        $borrow->nomor_peminjaman,
                        $borrow->user->name,
                        date("d-m-Y", strtotime($borrow->tanggal_pinjam)),
                        $borrow->details->count(),
                        $borrow->adminAssigned->name,
                        ($borrow->is_borrowed) ? "Sudah di kembalikan" : "Masih di pinjam",
                        $borrow->getDays($borrow->tanggal_pinjam),
                        ($borrow->keterlambatan == 0) ? "Tidak ada Keterlambatan" : $borrow->keterlambatan,
                        ($borrow->denda == 0) ? "Tidak ada denda" : $borrow->denda
                    ]);
                }
            });
        })->export('xls');
    }

    private function exportPdf($borrows)
    {
        $pdf = PDF::loadview('pdf.borrows', compact('borrows'));
        return $pdf->download('data-peminjaman.pdf');
    }

}
