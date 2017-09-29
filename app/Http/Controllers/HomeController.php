<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laratrust\LaratrustFacade as Laratrust;
use Illuminate\Support\Facades\Auth;
use App\Author;
use App\Member;
use App\Borrowlog;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Laratrust::hasRole('kepala')) return $this->adminDashboard();
        if (Laratrust::hasRole('admin')) return $this->adminDashboard();
        if (Laratrust::hasRole('staff')) return $this->adminDashboard();
        if (Laratrust::hasRole('member')) return $this->memberDashboard();

        return view('home');
    }

    protected function adminDashboard()
    {
        $members = ['Januari','Februari', 'Maret', 'April', 'Mei','Juni','Juli','Agustus','September','November','Desember'];
        $borrows = [];
        $i = 1;
        
        foreach ($members as $member) {
            array_push($borrows, BorrowLog::where( DB::raw('MONTH(created_at)'), '=', $i )->count());
            $i++;
        }

        return view('dashboard.admin', compact('members', 'borrows'));
    }

    protected function memberDashboard()
    {
        $borrowLogs = Auth::user()->borrowLogs()->borrowed()->get();
        return view('dashboard.member', compact('borrowLogs'));
    }
}
