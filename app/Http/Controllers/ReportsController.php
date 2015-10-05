<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    public function index()
    {
        return view('pages/reports/reports');
    }

    public function wdTxReport()
    {
        return view('pages/reports/wdTxReport');
    }
}
