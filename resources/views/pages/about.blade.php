@extends('layouts.app')
@section('title', __('About') . ' — Al Zain')

@section('content')
<section class="bg-blush-100/50">
    <div class="container-x py-16 max-w-3xl">
        <span class="eyebrow">{{ __('Our Story') }}</span>
        <h1 class="mt-2 text-4xl md:text-5xl">{{ __('Beauty, cared for properly') }}</h1>
        <p class="mt-5 text-lg text-plum-700/80 leading-relaxed">
            {{ __('Al Zain began as a small ladies salon in Muscat with one belief: every woman deserves expert care and honest products. Today we bring the salon chair and the shelf together — book a treatment, then take the same trusted skincare home.') }}
        </p>
    </div>
</section>

<div class="container-x py-16 grid md:grid-cols-3 gap-8">
    <div class="card p-6">
        <h3 class="text-xl">{{ __('Trained specialists') }}</h3>
        <p class="mt-2 text-sm text-plum-700/80">{{ __('Our team is certified in skincare, facials, hair and nails — and keeps learning.') }}</p>
    </div>
    <div class="card p-6">
        <h3 class="text-xl">{{ __('Curated, not crowded') }}</h3>
        <p class="mt-2 text-sm text-plum-700/80">{{ __('We only sell what we use. Every product on the shop is tested in our treatment rooms.') }}</p>
    </div>
    <div class="card p-6">
        <h3 class="text-xl">{{ __('A women-only space') }}</h3>
        <p class="mt-2 text-sm text-plum-700/80">{{ __('Private, comfortable and calm — designed for you to relax completely.') }}</p>
    </div>
</div>

@if($branches->isNotEmpty())
<div class="container-x pb-16">
    <h2 class="text-2xl md:text-3xl mb-8">{{ __('Where to find us') }}</h2>
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($branches as $branch)
            <div class="card p-6">
                <h3 class="text-lg">{{ $branch->name }}</h3>
                <p class="mt-1 text-sm text-rose-500">{{ $branch->city }}</p>
                <p class="mt-3 text-sm text-plum-700/80">{{ $branch->address }}</p>
                @if($branch->phone)<p class="mt-2 text-sm font-medium" dir="ltr">{{ $branch->phone }}</p>@endif
                @if($branch->hours)
                    <ul class="mt-3 text-xs text-plum-700/70 space-y-0.5">
                        @foreach($branch->hours as $line)
                            <li>{{ is_array($line) ? implode(' — ', $line) : $line }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endif
@endsection
