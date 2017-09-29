<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\LibrarySetting;
use Session;
class LibrarySettingsController extends Controller
{
    public function edit(){
        $setting = LibrarySetting::first();
        return view('library_settings.edit-setting')->with(compact('setting'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'biaya_denda'  => 'required|numeric',
            'maksimal_hari' => 'required|numeric'
        ]);

        $setting = LibrarySetting::first();
        $setting->update($request->all());
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Pengaturan denda berhasil diubah"
        ]);

        return redirect('data/settings/library');
    }
}
