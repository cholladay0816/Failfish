<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        if(now('America/Chicago')->daysUntil('2020-12-25 00:00:00')->count() == 0)
        {
            return response(file_get_contents(public_path('img/austingrinch.png')),'200',["Content-Type"=>'image/png']);
        }
        elseif(now('America/Chicago')->daysUntil('2020-11-26 00:00:00')->count() == 0)
        {
            return response(file_get_contents(public_path('img/austinturkey.png')),'200',["Content-Type"=>'image/png']);
        }
        return response(file_get_contents(public_path('img/austin.png')),'200',["Content-Type"=>'image/png']);
    }
}
