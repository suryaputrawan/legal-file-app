<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Template;
use App\Models\Agreement;
use App\Models\IzinNakes;
use Illuminate\Http\Request;
use App\Models\IzinCorporate;

class DashboardController extends Controller
{
    public function show()
    {
        $employee = Employee::all()->count();
        $izinCorporate = IzinCorporate::all()->count();
        $izinNakes = IzinNakes::all()->count();
        $agreement = Agreement::all()->count();
        $template = Template::get()->count();

        return view('dashboard', compact('employee', 'izinCorporate', 'izinNakes', 'agreement', 'template'));
    }
}
