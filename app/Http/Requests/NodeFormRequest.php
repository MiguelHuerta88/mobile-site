<?php
/**
 * Register Request
 */

namespace App\Http\Requests;

use App\Http\Requests\Request;

/**
 * NodeFormRequest
 * 
 * @author Miguel Huerta <guelme88@gmail.com>
 */
class NodeFormRequest extends Request
{
    /**
     * Get the validation rules
     * 
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|max:255|in:about,project,download',
            'title' => 'required|max:255',
            'body' => 'required',
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

