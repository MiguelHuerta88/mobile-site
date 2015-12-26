<?php
/**
 * AdminController
 */

namespace App\Http\Controllers;

class AdminController extends \App\Http\Controllers\Controller
{
    /**
     * construct
     */
    public function __construct() {
        // leave blank
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

