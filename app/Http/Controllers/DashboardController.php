<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{File};

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $subtitle = [
            'subtitle' => 'Dashboard',
        ];
        $countFile = File::all()->count();
        return view('dashboard.index', compact('title','subtitle','countFile'));
    }
}
