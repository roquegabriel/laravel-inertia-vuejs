<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    //
    public function index(Request $request): Response
    {
        $listing = $request->user()->role !== 'suspended' ?  $request->user()->listing()->latest()->paginate() : null;
        return Inertia::render('Dashboard', [
            'listings' => $listing,
            'status' => session('status')
        ]); 
    }
}