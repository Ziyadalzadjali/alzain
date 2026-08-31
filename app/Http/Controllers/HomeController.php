<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Product;
use App\Models\Service;
use App\Models\ServiceCategory;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'serviceCategories' => ServiceCategory::active()->take(6)->get(),
            'featuredServices' => Service::active()->where('is_featured', true)->with('category')->take(4)->get(),
            'featuredProducts' => Product::active()->where('is_featured', true)->take(8)->get(),
            'branches' => Branch::active()->get(),
        ]);
    }
}
