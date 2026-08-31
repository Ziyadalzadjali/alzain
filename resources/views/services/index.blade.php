@extends('layouts.app')
@section('title', __('Salon Services') . ' — Al Zain')

@section('content')
<section class="bg-blush-100/50">
    <div class="container-x py-14">
        <span class="eyebrow">{{ __('Salon Menu') }}</span>
        <h1 class="mt-2 text-4xl md:text-5xl">{{ __('Salon Services') }}</h1>
        <p class="mt-3 text-plum-700/80 max-w-xl">{{ __('Hair, facials, nails, brows and more — performed by our specialists. Prices in OMR.') }}</p>
    </div>
</section>

<div class="container-x py-10">
    <div class="flex flex-wrap gap-2 mb-10">
        <a href="{{ route('services.index') }}" class="btn {{ ! $activeCategory ? 'btn-primary' : 'btn-outline' }} !py-2 !px-4 text-xs">{{ __('All') }}</a>
        @foreach($categories as $cat)
            <a href="{{ route('services.index', ['category' => $cat->slug]) }}#{{ $cat->slug }}"
               class="btn {{ $activeCategory === $cat->slug ? 'btn-primary' : 'btn-outline' }} !py-2 !px-4 text-xs">{{ $cat->name }}</a>
        @endforeach
    </div>

    @forelse($categories as $cat)
        @if($cat->services->isNotEmpty())
        <section id="{{ $cat->slug }}" class="mb-16 scroll-mt-24">
            <div class="flex items-baseline gap-3 border-b border-blush-200 pb-3 mb-8">
                <h2 class="text-2xl md:text-3xl">{{ $cat->name }}</h2>
                <span class="text-sm text-plum-700/50">{{ $cat->services->count() }} {{ __('treatments') }}</span>
            </div>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($cat->services as $service)
                    <x-service-card :service="$service" />
                @endforeach
            </div>
        </section>
        @endif
    @empty
        <p class="text-plum-700/60">{{ __('No services published yet.') }}</p>
    @endforelse
</div>
@endsection
