<?php
// ============================================================
// app/Http/Controllers/Admin/DashboardController.php
// ============================================================
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Service, PortfolioItem, Client, Testimonial, Branch};

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'services'    => Service::count(),
            'portfolio'   => PortfolioItem::count(),
            'clients'     => Client::count(),
            'testimonials'=> Testimonial::count(),
            'branches'    => Branch::count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }
}
