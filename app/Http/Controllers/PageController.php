<?php

namespace App\Http\Controllers;

use App\Models\Node;
use App\Models\Social;
use App\Http\Controllers\Controller;
/**
 * PageController
 * 
 * @author Miguel Huerta <guelme88@gmail.com>
 */
class PageController extends Controller
{
    /**
     * Node instance
     * 
     * @var Node
     */
    protected $nodeModel;
    
    /**
     * constructor
     * 
     * @param Social $sicialModel
     * @param Node $nodeModel
     */
    public function __construct(
        Social $socialModel,
        Node $nodeModel
    ) {
        // call the parent construct
        parent::__construct($socialModel);
        
        $this->nodeModel = $nodeModel;
    }
    
    /**
     * view page
     * 
     * @param $type string (about|project|download)
     */
    public function view($type)
    {
        // get the model based on the type
        $node = $this->nodeModel->nodeByType($type)->orderBy('id', 'desc')->first();
        
        // return view
        return view('page_view')->with(compact('node'));
    }
}

