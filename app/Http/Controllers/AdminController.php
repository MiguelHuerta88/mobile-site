<?php
/**
 * AdminController
 */

namespace App\Http\Controllers;

use App\Models\Social;

class AdminController extends \App\Http\Controllers\Controller
{
    /**
     * construct
     */
    public function __construct(Social $socialModel) {
        parent::__construct($socialModel);
    }
    
    /**
     * index function
     * 
     * @return view Description
     */
    public function index()
    {
        return view('admin.admin_home_view');
    }
}

