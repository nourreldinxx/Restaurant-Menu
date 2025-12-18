<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function menu()
    {
        $menuItems = MenuItem::with('category')->get();
        return view('menu', compact('menuItems'));
    }

    public function booking()
    {
        return view('booking');
    }

    public function about()
    {
        return view('about');
    }

    public function contacts()
    {
        return view('contacts');
    }
}
