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
            'name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
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

