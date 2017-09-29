<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Member;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('user-should-verified');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_identitas' => 'required|unique:members',
            'alamat' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        DB::beginTransaction();
        try {

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => 'member'
        ]);


        $member = Member::create([
            'user_id' => $user->id,
            'kode_member'=>'KD-'. $user->id,
            'tempat_lahir' => $data['tempat_lahir'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'no_identitas' => $data['no_identitas'],
            'alamat' => $data['alamat'],
            'jenis_kelamin' => $data['jenis_kelamin']
        ]);

        $memberRole = Role::where('name', 'member')->first();
        $user->attachRole($memberRole);
        $user->sendVerification();

        } catch(ValidationException $e)
        {
            return Redirect::to('/register')
        ->withErrors( $e->getErrors() )
        ->withInput();
        }   

        DB::commit();
        return $user;
    }

    public function verify(Request $request, $token)
    {
        $email = $request->get('email');
        $user  = User::where('verification_token', $token)->where('email', $email)->first();
        if ($user) {
            $user->verify();
            Session::flash("flash_notification", [
                "level"   => "success",
                "message" => "Berhasil melakukan verifikasi."
            ]);
            Auth::login($user);
        }
        return redirect('/');
    }

    public function sendVerification(Request $request)
    {
        $user = User::where('email', $request->get('email'))->first();
        if ($user && !$user->is_verified) {
            $user->sendVerification();
            Session::flash("flash_notification", [
                "level"=>"success",
                "message"=>"Silahkan klik pada link aktivasi yang telah kami kirim."
            ]);
        }
        return redirect('/login');
    }
}
