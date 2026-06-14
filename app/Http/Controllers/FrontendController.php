<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\HeroSlider;
use App\Models\AboutContent;
use App\Models\AboutFeature;
use App\Models\AboutStat;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\Testimonial;
use App\Models\Chef;
use App\Models\Location;
use App\Models\Contact;
use App\Models\Reservation;
use App\Models\EventType;
use App\Models\FeaturedEvent;


class FrontendController extends Controller
{
    public function index()
    {
        $heroes = HeroSlider::where('is_active', true)->orderBy('order_number')->get() ?? collect();
        $about = AboutContent::first(); // hanya 1 baris
        $features = AboutFeature::orderBy('order_number')->get();
        $stats = AboutStat::orderBy('order_number')->get();
        $menuItems = MenuItem::all();
        $categories = MenuCategory::with('items')->get();
        $testimonials = Testimonial::all();
        $location = Location::first();
        $contact = Contact::first();
        $eventTypes = EventType::all();
        $featuredEvents = FeaturedEvent::with('eventType')->get();
        $featuredItems = MenuItem::where('is_featured', true)->get();
        $chefs = Chef::orderBy('order_number')->get();


        return view('index', compact(
            'heroes',
            'about',
            'features',
            'stats',
            'categories',
            'menuItems',
            'eventTypes',
            'testimonials',
            'chefs',
            'location',
            'featuredEvents',
            'eventTypes',
            'contact',
            'featuredItems'
        ));
    }

    public function storeReservation(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:20',
            'people' => 'required|integer',
            'date' => 'required|date',
            'time' => 'required',
            'message' => 'nullable|string|max:500',
        ]);

        try {
            Reservation::create(array_merge($validated, ['status' => 'pending']));
            return redirect(url()->previous() . '#book-a-table')->with('success', 'Permintaan reservasi Anda telah diterima!');
        } catch (\Exception $e) {
            return redirect(url()->previous() . '#book-a-table')->with('error', 'Failed to save reservation: ' . $e->getMessage());
        }
    }
}
