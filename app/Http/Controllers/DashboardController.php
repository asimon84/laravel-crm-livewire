<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the view for the Dashboard page
     *
     * @param Request $request
     *
     * @return View
     */
    public function index(Request $request):View {
        $chartData = Record::getRecordsLastXDays(7);

        return view('dashboard', compact('chartData'));
    }
}
