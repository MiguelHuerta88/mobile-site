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
class LoginRequest extends Request
{
    /**
     * Get the validation rules
     * 
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required',
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

