<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function index()
    {
        // 一時休止中なので 503 Service Unavailable を返す
        return response()->view('photos.index')->setStatusCode(503);
    }
}
