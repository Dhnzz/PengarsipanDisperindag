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
        $fileYearData = [];
        $years = File::distinct()->pluck('date')->map(function($date) {
            return date('Y', strtotime($date));
        })->sort();
        foreach ($years as $year) {
            $fileYearData[$year] = File::whereYear('date', $year)->count();
        }
        // dd($fileYearData);
        return view('dashboard.index', compact('title','subtitle','countFile','fileYearData'));
    }
}
