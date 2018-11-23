<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use Auth;
use URL;
use Notification;
use App\Models\Social;
use Validator;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Social $socialModel)
    {
        parent::__construct($socialModel);
        $this->middleware('guest')->except('logout');
    }

    /**
     * login function
     * 
     * @return view
     */
    public function login()
    {
        return view('admin.login');
    }
    
    /**
     * doLogin
     * 
     * @return view
     */
    public function doLogin(LoginRequest $request)
    {
        $input = $request->except('_token');
        
        // attempt to login
        if(Auth::attempt($input)) {
            return redirect()->route('admin.home');
        }
        // redirect them back
        Notification::error('User not found.');
        return redirect()->back()->withInput();
    }
    
    /**
     * logout function
     * 
     * @return view
     */
    public function logout()
    {
        Auth::logout();

        // redirect them to our home page
        return redirect()->route('site.home');
    }
}
