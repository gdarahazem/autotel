<?php

namespace App\Http\Controllers;

class DashBoardAdminController extends Controller
{
    public function index()
    {
//        dd("heelo");
        return view("admin.dashboard");
    }
}
