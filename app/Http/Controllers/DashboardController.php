<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Page;

class DashboardController extends Controller
{
    public function index()
    {
    	$pages = Page::all(); 
    	$usuarios = User::all();
        $title = 'Dashboard';
        return view('cms.dashboard', compact('title', 'pages', 'usuarios'));
    }
}
