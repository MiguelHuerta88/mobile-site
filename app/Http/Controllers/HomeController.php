<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Node;
use App\Models\Social;

class HomeController extends Controller
{
    /**
     * @var Node Model
     */
    public $node;

    /**
     * construct
     */
    public function __construct(Social $socialModel, Node $node) {
        parent::__construct($socialModel);

        $this->node = $node;
    }


    /**
     * home function
     */
    public function home()
    {
        // this is now a bit more complex. We have to also pull the page section
        $sections = $this->node->all();

        return view('homepage')->with('sections', $sections);
    }
}

