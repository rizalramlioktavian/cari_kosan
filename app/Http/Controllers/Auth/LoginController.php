<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // fungsi login
    public function login(Request $request): RedirectResponse
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password wajib diisi',
        ]);

        $credentials = [
            'email' => $input['email'],
            'password' => $input['password'],
        ];

        if (Auth::attempt($credentials)) {
            if(Auth::user()->role == 'admin') {
                return redirect()->route('admin.home')->with('success', 'Selamat Datang di Website Telnest'. Auth::user()->name);
            }else {
                // return redirect()->route('home')->with('success', 'Selamat Datang <strong>', di Website Telnest');
                if (session()->has('url.intended')) {
                    return redirect(session()->get('url.intended'));
                } else {
                    return redirect()->route('home')->with('success', 'Selamat Datang <strong>' . Auth::user()->name . '</strong> di Website Telnest.');
                }
            }
        } else {
            $user = User::where('email', $input['email'])->first();

            if ($user) {
                return redirect()->route('login')->with('error', 'Email atau password salah! Silahkan coba lagi.');
            } else {
                return redirect()->route('login')->with('error', 'Email tidak terdaftar! Silahkan daftar terlebih dahulu.');
            }
        }
    }
}
