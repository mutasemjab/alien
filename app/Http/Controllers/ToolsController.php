<?php

namespace App\Http\Controllers;

class ToolsController extends Controller
{
    public function index()            { return view('front.tools.index'); }
    public function salary()           { return view('front.tools.salary'); }
    public function incomeTax()        { return view('front.tools.income-tax'); }
    public function endOfService()     { return view('front.tools.end-of-service'); }
    public function vat()              { return view('front.tools.vat'); }
    public function projectEstimator() { return view('front.tools.project-estimator'); }
}
