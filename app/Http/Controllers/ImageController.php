<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function showDaily()
    {
        $daily = Image::where('active',1)->first();
        return response(file_get_contents(public_path('img/'.$daily->name.'.png')),'200',["Content-Type"=>'image/png']);
    }
}
