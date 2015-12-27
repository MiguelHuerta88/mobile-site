<?php
/**
 * Register Controller
 */

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Hash;
use Auth;
use Notification;
use App\Models\Social;

/**
 * REgister Controller class
 * 
 * @author Miguel Huerta <guelme88@gmail.com>
 */
class RegisterController extends Controller
{
    /**
     * user model instance
     * 
     * @var UerModel
     */
    protected $userModel;
    
    /**
     * constructor
     * 
     * @param UserModel
     */
    public function __construct(
        User $userModel,
        Social $socialModel
    ) {
        parent::__construct($socialModel);
        $this->userModel = $userModel;
    }
    
    /**
     * Register function
     * 
     * @return view
     */
    public function register()
    {
        // this will just display a form that we will validate in a post
        return view('admin.register_view');
    }
    
    /**
     * Do Register functino
     * 
     * @param RegisterRequest $request
     * @return view
     */
    public function doRegister(RegisterRequest $request)
    {
        // if we made it this far then we have successfully passed
        // the validation phase
        
        // first hash the password
        $password = Hash::make($request->input('password'));
        
        // get all input except the password
        $input = $request->except('password');
        
        // now add the password
        $input['password'] = $password;

        // now we will add create a new record in the user table
        $user = $this->userModel->create($input);
        
        if($user) {
            // loggin the user
            Auth::login($user);
            
            // show a flash message and then send them to the admin home
            Notification::success('User '. $request->input('username') . 
                    ' was created.');
            return redirect()->route('admin.home');
        }
        Notification::error('User could not be created.');
        return redirect()->back()->withInput();
    }
}

