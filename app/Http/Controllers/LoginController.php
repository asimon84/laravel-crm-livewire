<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Show the view for the Login page
     *
     * @param Request $request
     *
     * @return View
     */
    public function index(Request $request):View {
        return view('login', []);
    }
}
