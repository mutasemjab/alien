<?php

namespace App\Http\Controllers;

use App\Models\{Blog, HeroSection, JobPosition, Service, PortfolioItem, Client, Testimonial, Branch, Setting};
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $hero         = HeroSection::active();
        $services     = Service::active()->ordered()->get();
        $portfolio    = PortfolioItem::active()->ordered()->get();
        $clients      = Client::active()->ordered()->get();
        $testimonials = Testimonial::active()->ordered()->get();
        $branches     = Branch::active()->ordered()->get();

        $latestPosts   = Blog::active()->published()->articles()->ordered()->take(3)->get();
        $openPositions = JobPosition::active()->ordered()->get();

        return view('front.home', compact(
            'hero', 'services', 'portfolio', 'clients', 'testimonials',
            'branches', 'latestPosts', 'openPositions'
        ));
    }

    public function services()
    {
        $services = Service::active()->ordered()->get();
        return view('front.services', compact('services'));
    }

    public function serviceDetail(string $slug)
    {
        $service = Service::active()
            ->where('slug', $slug)
            ->whereNotNull('slug')
            ->firstOrFail();

        $relatedServices = Service::active()
            ->hasDetail()
            ->where('id', '!=', $service->id)
            ->ordered()
            ->take(4)
            ->get();

        return view('front.services.show', compact('service', 'relatedServices'));
    }

    public function portfolio()
    {
        $portfolio = PortfolioItem::active()->ordered()->get();
        return view('front.portfolio', compact('portfolio'));
    }

    public function contact()
    {
        $branches = Branch::active()->ordered()->get();
        return view('front.contact', compact('branches'));
    }

    public function sendContact(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'message' => 'required|string',
        ]);

        // Mail::to(Setting::getValue('contact_email'))->send(new ContactMail($request->all()));

        return back()->with('success', __('front.contact_sent'));
    }
}
