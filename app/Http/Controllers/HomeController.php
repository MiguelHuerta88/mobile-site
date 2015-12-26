<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * constructor
     */
    public function __construct()
    {
        // blank for now.
    }
    
    /**
     * home function
     */
    public function home()
    {
        return view('homepage'); 
    }
}

