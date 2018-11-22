<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Social;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * constructor. This will then call share
     * 
     * @param Social $socialsModel
     */
    public function __construct(Social $socialModel) {
        $this->socialModel = $socialModel;
        
        $links = $this->socialModel->all();

        // share this with all views
        view()->share('links', $links);
    }
}
