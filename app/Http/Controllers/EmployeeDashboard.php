<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeDashboard extends Controller
{

    public function dashboard(){
        return view('employee.dashboard');
    }
}
