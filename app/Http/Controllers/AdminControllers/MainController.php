<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index():View
    {
        return view('admin.main');
    }
}
