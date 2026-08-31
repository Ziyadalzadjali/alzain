<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about', ['branches' => Branch::active()->get()]);
    }

    public function contact()
    {
        return view('pages.contact', ['branches' => Branch::active()->get()]);
    }

    public function contactStore(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['nullable', 'email', 'max:160'],
            'phone' => ['nullable', 'string', 'max:40'],
            'subject' => ['nullable', 'string', 'max:160'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        ContactMessage::create($data);

        return back()->with('status', __('Thank you — we will be in touch shortly.'));
    }

    public function policy(string $page)
    {
        abort_unless(in_array($page, ['privacy', 'terms', 'shipping-returns'], true), 404);

        return view('pages.policy', ['page' => $page]);
    }
}
