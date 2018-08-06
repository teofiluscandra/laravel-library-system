<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Member;
use App\Staff;
use Illuminate\Support\Facades\File;


class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        if(auth()->user()->role == 'member'){
            $member = Member::where('user_id', auth()->user()->id)->first();
            return view('settings.profile',compact('member'));
        } else if(auth()->user()->role == 'staff'){
            $staff = Staff::where('user_id', auth()->user()->id)->first();
            return view('settings.show-profile-staff',compact('staff'));
        }
        
    }

    public function editProfile()
    {
        if(auth()->user()->role == 'member'){
            $member = Member::where('user_id', auth()->user()->id)->first();
            return view('settings.edit-profile',compact('member'));
        }
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'name'  => 'required',
            'email' => 'required|unique:users,email,' . $user->id
        ]);

        $member = Member::where('user_id', auth()->user()->id)->first();
        $member->update($request->except('name','email','foto'));
        $user->name  = $request->get('name');
        $user->email = $request->get('email');
        $user->save();

        if ($request->hasFile('foto')) {
            $filename = null;
            $uploaded_foto = $request->file('foto');
            $extension = $uploaded_foto->getClientOriginalExtension();
            $filename = md5(time()) . '.' . $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
            $uploaded_foto->move($destinationPath, $filename);
            if ($member->foto) {
                $old_foto = $member->foto;
                $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
                    . DIRECTORY_SEPARATOR . $member->foto;

                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                }
            }
            $member->foto = $filename;
            $member->save();
        }

        

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Profil berhasil diubah"
        ]);

        return redirect('settings/profile');
    }

    public function editPassword()
    {
        return view('settings.edit-password');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'password' => 'required|passcheck:' . $user->password,
            'new_password' => 'required|confirmed|min:6',
        ], [
            'password.passcheck' => 'Old password is not match'
        ]);

        $user->password = bcrypt($request->get('new_password'));
        $user->save();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Password berhasil diubah"
        ]);

        return redirect('settings/password');
    }
}
