<?php
/**
 * Register Request
 */

namespace App\Http\Requests;

use App\Http\Requests\Request;

/**
 * RegisterRequest
 * 
 * @author Miguel Huerta <guelme88@gmail.com>
 */
class RegisterRequest extends Request
{
    /**
     * Get the validation rules
     * 
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'username' => 'required|unique:users,username|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|max:255'
        ];
    }
    
    public function authorize()
    {
        // Only allow logged in users
        // return \Auth::check();
        // Allows all users in
        return true;
    }
}

