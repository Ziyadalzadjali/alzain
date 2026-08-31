@extends('layouts.app')
@section('title', __('Booking Confirmed') . ' — Al Zain')

@section('content')
<div class="container-x py-16 max-w-xl text-center">
    <div class="mx-auto w-16 h-16 rounded-full bg-blush-100 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-plum-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
        </svg>
    </div>
    <h1 class="mt-6 text-3xl md:text-4xl">{{ __('Your appointment is booked') }}</h1>
    <p class="mt-3 text-plum-700/80">{{ __('Reference') }}: <span class="font-semibold" dir="ltr">{{ $booking->reference }}</span></p>

    <div class="mt-8 card p-6 text-start space-y-3 text-sm">
        <div class="flex justify-between"><span class="text-plum-700/60">{{ __('Service') }}</span><span class="font-medium">{{ $booking->service->name }}</span></div>
        <div class="flex justify-between"><span class="text-plum-700/60">{{ __('Branch') }}</span><span class="font-medium">{{ $booking->branch->name }}</span></div>
        @if($booking->staff)
        <div class="flex justify-between"><span class="text-plum-700/60">{{ __('Specialist') }}</span><span class="font-medium">{{ $booking->staff->name }}</span></div>
        @endif
        <div class="flex justify-between"><span class="text-plum-700/60">{{ __('Date') }}</span><span class="font-medium">{{ $booking->date->translatedFormat('l, d M Y') }}</span></div>
        <div class="flex justify-between"><span class="text-plum-700/60">{{ __('Time') }}</span><span class="font-medium" dir="ltr">{{ \Illuminate\Support\Str::of($booking->time)->substr(0,5) }}</span></div>
        <div class="flex justify-between"><span class="text-plum-700/60">{{ __('Name') }}</span><span class="font-medium">{{ $booking->customer_name }}</span></div>
        <div class="flex justify-between border-t border-blush-100 pt-3"><span class="text-plum-700/60">{{ __('Status') }}</span><span class="font-medium capitalize">{{ __(ucfirst($booking->status)) }}</span></div>
    </div>

    <p class="mt-6 text-sm text-plum-700/70">{{ __('We will contact you shortly to confirm. Please arrive 10 minutes early.') }}</p>

    <div class="mt-8 flex gap-3 justify-center">
        <a href="{{ route('services.index') }}" class="btn btn-outline">{{ __('Browse Services') }}</a>
        <a href="{{ route('shop.index') }}" class="btn btn-primary">{{ __('Shop Skincare') }}</a>
    </div>
</div>
@endsection
