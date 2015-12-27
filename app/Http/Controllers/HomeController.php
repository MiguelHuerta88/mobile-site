<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Social;

class HomeController extends Controller
{   
    /**
     * construct
     */
    public function __construct(Social $socialModel) {
        parent::__construct($socialModel);
    }


    /**
     * home function
     */
    public function home()
    {
        return view('homepage'); 
    }
}

