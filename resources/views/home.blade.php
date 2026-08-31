@extends('layouts.app')
@section('title', __('Al Zain — Salon, Skincare & Fashion for Ladies'))

@section('content')
{{-- Hero --}}
<section class="relative overflow-hidden bg-gradient-to-b from-blush-100 to-cream-50">
    <div class="container-x py-20 md:py-28 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <span class="eyebrow">{{ __('Ladies Salon & Beauty House') }}</span>
            <h1 class="mt-4 text-4xl md:text-6xl leading-tight text-plum-900">
                {{ __('Book your glow.') }}<br>
                <span class="text-rose-500">{{ __('Shop your ritual.') }}</span>
            </h1>
            <p class="mt-6 text-lg text-plum-700/80 max-w-md leading-relaxed">
                {{ __('Salon appointments, expert facials, and a curated shop of skincare and fashion — made for women, in Muscat.') }}
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('booking.create') }}" class="btn btn-primary">{{ __('Book an Appointment') }}</a>
                <a href="{{ route('shop.index') }}" class="btn btn-outline">{{ __('Explore the Shop') }}</a>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <x-placeholder label="{{ __('Facials') }}" seed="hero-1" class="aspect-[3/4] rounded-2xl" />
            <x-placeholder label="{{ __('Skincare') }}" seed="hero-2" class="aspect-[3/4] rounded-2xl mt-8" />
        </div>
    </div>
</section>

{{-- Service categories --}}
<section class="container-x py-16 md:py-20">
    <div class="flex items-end justify-between gap-4">
        <div>
            <span class="eyebrow">{{ __('Salon Menu') }}</span>
            <h2 class="mt-2 text-3xl md:text-4xl">{{ __('What would you like today?') }}</h2>
        </div>
        <a href="{{ route('services.index') }}" class="hidden sm:inline text-sm font-semibold text-rose-500 hover:underline">{{ __('View all services') }} &rarr;</a>
    </div>

    <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($serviceCategories as $cat)
            <a href="{{ route('services.index', ['category' => $cat->slug]) }}" class="card p-6 flex items-center gap-4">
                <x-placeholder :label="$cat->name" :seed="$cat->slug" class="w-16 h-16 rounded-full shrink-0" />
                <div>
                    <h3 class="text-lg">{{ $cat->name }}</h3>
                    <p class="text-sm text-plum-700/70 line-clamp-2">{{ \Illuminate\Support\Str::limit(strip_tags($cat->description), 70) }}</p>
                </div>
            </a>
        @empty
            <p class="text-plum-700/60">{{ __('Services will appear here soon.') }}</p>
        @endforelse
    </div>
</section>

{{-- Featured services --}}
@if($featuredServices->isNotEmpty())
<section class="bg-blush-100/50 py-16 md:py-20">
    <div class="container-x">
        <span class="eyebrow">{{ __('Guest Favourites') }}</span>
        <h2 class="mt-2 text-3xl md:text-4xl">{{ __('Signature treatments') }}</h2>
        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($featuredServices as $service)
                <x-service-card :service="$service" />
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Featured products --}}
@if($featuredProducts->isNotEmpty())
<section class="container-x py-16 md:py-20">
    <div class="flex items-end justify-between gap-4">
        <div>
            <span class="eyebrow">{{ __('The Shop') }}</span>
            <h2 class="mt-2 text-3xl md:text-4xl">{{ __('Take the ritual home') }}</h2>
        </div>
        <a href="{{ route('shop.index') }}" class="hidden sm:inline text-sm font-semibold text-rose-500 hover:underline">{{ __('Shop all') }} &rarr;</a>
    </div>
    <div class="mt-10 grid gap-5 grid-cols-2 lg:grid-cols-4">
        @foreach($featuredProducts as $product)
            <x-product-card :product="$product" />
        @endforeach
    </div>
</section>
@endif

{{-- Booking strip --}}
<section class="container-x">
    <div class="rounded-3xl bg-plum-700 text-cream-50 px-8 py-14 md:px-16 md:py-16 grid md:grid-cols-[1.5fr_1fr] gap-8 items-center">
        <div>
            <h2 class="text-3xl md:text-4xl text-cream-50">{{ __('Ready when you are') }}</h2>
            <p class="mt-3 text-blush-200 max-w-lg">{{ __('Choose a service, a branch, and a time that suits you. Confirmation is instant.') }}</p>
        </div>
        <a href="{{ route('booking.create') }}" class="btn btn-gold justify-self-start md:justify-self-end">{{ __('Book Now') }}</a>
    </div>
</section>

{{-- Branches --}}
@if($branches->isNotEmpty())
<section class="container-x py-16 md:py-20">
    <span class="eyebrow">{{ __('Visit Us') }}</span>
    <h2 class="mt-2 text-3xl md:text-4xl">{{ __('Our branches') }}</h2>
    <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($branches as $branch)
            <div class="card p-6">
                <h3 class="text-xl">{{ $branch->name }}</h3>
                <p class="mt-1 text-sm text-rose-500">{{ $branch->city }}</p>
                <p class="mt-3 text-sm text-plum-700/80">{{ $branch->address }}</p>
                @if($branch->phone)<p class="mt-3 text-sm font-medium text-plum-700" dir="ltr">{{ $branch->phone }}</p>@endif
            </div>
        @endforeach
    </div>
</section>
@endif
@endsection
