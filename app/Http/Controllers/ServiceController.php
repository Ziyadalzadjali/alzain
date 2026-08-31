<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $categories = ServiceCategory::active()->with(['services' => fn ($q) => $q->active()])->get();

        $activeCategory = $request->query('category');

        return view('services.index', compact('categories', 'activeCategory'));
    }

    public function show(Service $service)
    {
        abort_unless($service->is_active, 404);
        $service->load('category', 'staff');

        $related = Service::active()
            ->where('service_category_id', $service->service_category_id)
            ->where('id', '!=', $service->id)
            ->take(3)->get();

        return view('services.show', compact('service', 'related'));
    }
}
