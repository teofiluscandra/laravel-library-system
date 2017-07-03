<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Role;
use App\User;
use App\Member;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Facades\Datatables;
use App\Http\Requests\StoreMemberRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\UpdateMemberRequest;
use Excel;
use PDF;
use Illuminate\Support\Facades\Auth;


class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $members = Role::where('name', 'member')->first()->users;
            return Datatables::of($members)
                ->addColumn('kode_member', function($member) {
                    return $member->members->kode_member;
                })
                ->addColumn('name', function($member) {
                    return '<a href="'.route('members.show', $member->id).'">'.$member->name.'</a>';
                })
                ->addColumn('action', function($member){
                    return view('datatable._action', [
                        'model'           => $member,
                        'form_url'        => route('members.destroy', $member->id),
                        'edit_url' => route('members.edit', $member->id),
                        'confirm_message' => 'Yakin mau menghapus ' . $member->name . '?'
                    ]);
                })->make(true);
        }

        $html = $htmlBuilder
            ->addColumn(['data' => 'kode_member', 'name'=>'kode_member', 'title'=>'Kode Member'])
            ->addColumn(['data' => 'name', 'name'=>'name', 'title'=>'Nama'])
            ->addColumn(['data' => 'email', 'name'=>'email', 'title'=>'Email'])
            ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);

        return view('members.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMemberRequest $request)
    {

        $password = str_random(6);
        $data = $request->only('name','email');
        $data['password'] = bcrypt($password);
        // bypass verifikasi
        $data['is_verified'] = 1;
        $data['role'] = 'member';
        $member = User::create($data);
        
        $data_user = $request->only('tempat_lahir','tanggal_lahir','no_identitas','jenis_kelamin','alamat');
        $data_user['kode_member'] = 'KD-'.$member->id;
        $data_user['user_id'] = $member->id;
        $member_data = Member::create($data_user);
        // set role
        $memberRole = Role::where('name', 'member')->first();
        $member->attachRole($memberRole);

        // kirim email
        Mail::send('auth.emails.invite', compact('member', 'password'), function ($m) use ($member) {
            $m->to($member->email, $member->name)->subject('Anda telah didaftarkan di Dinas Kearsipan dan Perpustakaan Provinsi Bali!');
        });

        Session::flash("flash_notification", [
            "level"   => "success",
            "message" => "Berhasil menyimpan member dengan email " .
            "<strong>" . $data['email'] . "</strong>" .
            " dan password <strong>" . $password . "</strong>."
        ]);

        return redirect()->route('members.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = User::findOrFail($id);
        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = User::findOrFail($id);
        return view('members.edit')->with(compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMemberRequest $request, $id)
    {
        $this->validate($request, ['email' => 'required|unique:members,email,'. $id]);
        $member = User::find($id);
        $member->update($request->only('name','email'));

        $member_data = Member::where('user_id',$id)->first();
        $member_data->update($request->only('tempat_lahir','tanggal_lahir','no_identitas','jenis_kelamin','alamat'));

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $member->name"
        ]);

        return redirect()->route('members.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = User::find($id);
        
        if($member){
            if ($member->hasRole('member')) {
                $member->delete();
                // $member_data = Member::where('user_id',$id)->first();
                // $member_data->delete();
                Session::flash("flash_notification", [
                    "level"=>"success",
                    "message"=>"Member berhasil dihapus"
                ]);
            }
        }

        return redirect()->route('members.index');
    }

    public function export() 
    { 
        return view('members.export');
    }

    public function exportPost(Request $request) 
    { 
        // validasi
        $this->validate($request, [
            'type'=>'required|in:pdf,xls'
        ]);

        $members = Role::where('name', 'member')->first()->users;

        $handler = 'export' . ucfirst($request->get('type'));
        return $this->$handler($members);
    }

    private function exportXls($members)
    {
        Excel::create('Data Member Perpustakaan', function($excel) use ($members) {
            // Set the properties
            $excel->setTitle('Data Member Perpustakaan')
                ->setCreator(Auth::user()->name);

            $excel->sheet('Data Member', function($sheet) use ($members) {
                $row = 1;
                $sheet->row($row, [
                    'Kode Member',
                    'Nama',
                    'Email',
                    'Jenis Kelamin',
                    'Tempat Lahir',
                    'Tanggal Lahir',
                    'Nomor Identitas',
                    'Alamat'
                ]);
                foreach ($members as $member) {
                    $sheet->row(++$row, [
                        $member->members->kode_member,
                        $member->name,
                        $member->email,
                        $member->members->jenis_kelamin,
                        $member->members->tempat_lahir,
                        $member->members->tanggal_lahir,
                        $member->members->no_identitas,
                        $member->members->alamat
                    ]);
                }
            });
        })->export('xls');
    }

    private function exportPdf($members)
    {
        $pdf = PDF::loadview('pdf.members', compact('members'));
        return $pdf->download('members.pdf');
    }
}
