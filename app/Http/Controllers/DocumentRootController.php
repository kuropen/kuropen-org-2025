<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentRootController extends Controller
{
    public function index()
    {
        $documents = Document::limit(5)->orderBy('published_at', 'desc')->get();
        return view('home', compact('documents'));
    }
}
