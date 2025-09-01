<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function viewDashboard(){
        return view('/',[
            "title" => "Home"
        ]);
    }

    public function viewContact(){
        return view('/contact',[
            "title" => "Contact"
        ]);
    }

    public function viewAbout(){
        return view('/about',[
            "title" => "About"
        ]);
    }
}
