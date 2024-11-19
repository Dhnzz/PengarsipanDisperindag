<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $subtitle = [
            'subtitle' => 'Dashboard',
        ];
        return view('dashboard.index', compact('title','subtitle'));
    }
}
