<?php
/**
 * AdminController
 */

namespace App\Http\Controllers;

use App\Models\Social;
use App\Models\Node;
use App\Models\NodeType;
use App\Http\Requests\NodeFormRequest;
use Notification;

class AdminController extends \App\Http\Controllers\Controller
{
    /**
     * Node model instance
     * 
     * @var Node
     */
    protected $nodeModel;
    
    /**
     * NodeType model instance
     * 
     * @var NodeType
     */
    protected $nodeTypeModel;
    
    /**
     * construct
     */
    public function __construct(
            Social $socialModel,
            Node $nodeModel,
            NodeType $nodeTypeModel
    ) {
        parent::__construct($socialModel);
        $this->nodeModel = $nodeModel;
        $this->nodeTypeModel = $nodeTypeModel;
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
    
    /**
     * edit about page function
     * 
     * @return view
     */
    public function edit($type = 'about')
    {
        // we should gather any information from the tables and then send that
        // back to the view. We order by id desc because we can create new
        // type pages or edit
        $node = $this->nodeModel->nodeByType($type)->orderBy('id', 'desc')->first();
        // return view
 
        return view('admin.node_view')->with(compact('node'));
    }
    
    /**
     * post edit page function
     * 
     * @param NodeFormRequest $request
     * @return view
     */
    public function postEdit(NodeFormRequest $request)
    {   
        // first we save the node model
        $node = $this->nodeModel->find($request->input('id'));
        
        // save the node model
        $node->type = $request->input('type');
        $node->title = $request->input('title');
        $node->save();
        
        $nodeType = $node->nodeType;
        if($nodeType) {
            // instantiate nodeType model
            $nodeType->nid = $request->input('id');
            $nodeType->body = $request->input('body');
            // save model
            $nodeType->save();
        } else{
            
            $this->nodeTypeModel->create($request->input());
        }
        // we will flash a notification
        Notification::success($request->input('type') . ' page has been updated');
        return redirect()->route('admin.home');
    }
}

