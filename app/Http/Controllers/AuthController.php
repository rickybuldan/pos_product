<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Mail\VerificationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Mail;



class AuthController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan halaman indeks pengguna
        return view('auth.login');
    }

    // public function signup()
    // {
    //     return view('auth.signup');
    // }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email cannot be empty.',
            'email.email' => 'Invalid email format.',
            'password.required' => 'Password cannot be empty.',
        ]);

        $credentials = $request->only('email', 'password');

        if ($user = User::where('email', $request->email)->first()) {
            // Check if the user is active
            if ($user->is_active == 1 && Auth::attempt($credentials)) {
                Auth::logoutOtherDevices($request->password);

                if (Auth::user()->roles->first()->role_name == "Customer") {
                    Session::put('user_id', Auth::user()->id);
                    Session::put('name', Auth::user()->name);
                    Session::put('role_id', Auth::user()->role_id);
                    return redirect(route('home'));
                } else {
                    Session::put('user_id', Auth::user()->id);
                    Session::put('name', Auth::user()->name);
                    Session::put('role_id', Auth::user()->role_id);

                    return redirect()->intended('/');
                }
            } else {
                return redirect()
                    ->back()
                    ->withErrors(['email' => $user->is_active ? 'Invalid credentials' : 'Silakan verifikasi email terlebih dahulu.'])
                    ->withInput($request->except('password'));
            }
        } else {
            return redirect()
                ->back()
                ->withErrors(['email' => 'Email tidak terdaftar.'])
                ->withInput($request->except('password'));
        }

    }
    public function logout(Request $request)
    {
        Auth::logout();

        Session::forget('user_id');
        Session::forget('name');
        Session::forget('role_id');

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function signup(Request $request)
    {

        if ($request->isMethod('post')) {
            $data = json_decode($request->getContent());
            $user = User::where('email', $data->email)->first();

            $baseURL = url('/');
            if (!$user) {

                $saved = User::create(

                    [
                        'name' => $data->name,
                        'email' => $data->email,
                        'phone' => $data->phone,
                        'address' => $data->address,
                        'role_id' => 11,
                        'password' => Hash::make($data->password),
                        'is_active' => 0,


                    ] // Kolom yang akan diisi
                );

                if ($saved) {
                    $name = $data->name;
                    $email = $data->email;
                    $sub = "Verification KIMISHOP";
                    $mess = "silakan klik link ini untuk verifikasi email " . $baseURL . "/verifyemail?code=" . encrypt($saved->id);

                    $send_mail = $data->email;
                    $mail = Mail::to($send_mail)->send(new SendMail($name, $email, $sub, $mess));

                    $results = [
                        'code' => 0,
                        'info' => 'Success, silakan verifikasi email anda untuk login.',
                    ];

                    return $results;

                } else {
                    $results = [
                        'code' => 1,
                        'info' => 'Registrasi gagal',
                    ];

                    return $results;
                }

            } else {

                $results = [
                    'code' => 1,
                    'info' => 'Email sudah terdaftar!',
                ];

                return $results;

            }
        } else {
            return view('auth.signup');
        }
    }
    public function verifyemail(Request $request)
    {
        $uid = decrypt($request->query('code'));
        $saved = User::updateOrCreate(
            [
                'id' => $uid,
            ],
            [
                'is_active' => 1,
            ] // Kolom yang akan diisi
        );
        if ($saved) {
            return view('auth.login')->withErrors(['email' => 'Email berhasil diverifikasi silakan login.']);
        } else {
            return view('auth.login')->withErrors(['email' => 'Verifikasi gagal silakan coba lagi.']);
        }


    }
}
