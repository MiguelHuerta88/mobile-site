<?php
/**
 * Register Controller
 */

namespace App\Http\Controllers;

use App\Models\User;

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
    public function __construct(User $userModel) {
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
}

