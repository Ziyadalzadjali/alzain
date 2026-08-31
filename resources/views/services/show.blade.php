@extends('layouts.app')
@section('title', $service->name . ' — Al Zain')

@section('content')
<div class="container-x py-10">
    <nav class="text-xs text-plum-700/60 mb-6">
        <a href="{{ route('services.index') }}" class="hover:underline">{{ __('Services') }}</a>
        <span class="mx-2">/</span>
        <span>{{ $service->category?->name }}</span>
    </nav>

    <div class="grid lg:grid-cols-2 gap-10">
        <div>
            @if($service->image)
                <img src="{{ $service->image }}" alt="{{ $service->name }}" class="rounded-2xl w-full object-cover aspect-[4/3]">
            @else
                <x-placeholder :label="$service->name" :seed="$service->id" class="aspect-[4/3] rounded-2xl" />
            @endif
        </div>

        <div>
            <span class="eyebrow">{{ $service->category?->name }}</span>
            <h1 class="mt-2 text-3xl md:text-4xl">{{ $service->name }}</h1>

            <div class="mt-4 flex items-center gap-5 text-sm">
                <span class="text-xl font-semibold text-plum-700">{{ omr($service->price) }}</span>
                <span class="text-plum-700/60">{{ __('Duration') }}: {{ $service->duration_minutes }} {{ __('min') }}</span>
            </div>

            <div class="prose prose-sm mt-6 text-plum-700/85 leading-relaxed max-w-none">
                {!! nl2br(e($service->description)) !!}
            </div>

            @if($service->staff->isNotEmpty())
                <div class="mt-6">
                    <h3 class="text-sm font-semibold text-plum-700 uppercase tracking-wider">{{ __('Performed by') }}</h3>
                    <div class="mt-3 flex flex-wrap gap-2">
                        @foreach($service->staff as $member)
                            <span class="text-xs bg-blush-100 text-plum-700 rounded-full px-3 py-1">{{ $member->name }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

            <a href="{{ route('booking.create', ['service' => $service->id]) }}" class="btn btn-primary mt-8">{{ __('Book This Service') }}</a>
        </div>
    </div>

    @if($related->isNotEmpty())
        <section class="mt-20">
            <h2 class="text-2xl mb-8">{{ __('You might also like') }}</h2>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($related as $service)
                    <x-service-card :service="$service" />
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
