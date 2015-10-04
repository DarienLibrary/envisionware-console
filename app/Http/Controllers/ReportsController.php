<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    public function index()
    {
        return view('pages/report');
    }

    public function report($rtype)
    {
        return view('pages/report', compact('rtype'));
    }
}
