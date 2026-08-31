@extends('layouts.app')
@section('title', __('Book an Appointment') . ' — Al Zain')

@section('content')
<section class="bg-blush-100/50">
    <div class="container-x py-14">
        <span class="eyebrow">{{ __('Salon Booking') }}</span>
        <h1 class="mt-2 text-4xl md:text-5xl">{{ __('Book an Appointment') }}</h1>
        <p class="mt-3 text-plum-700/80 max-w-xl">{{ __('Pick a service, a branch and a time. We will confirm by phone or email.') }}</p>
    </div>
</section>

<div class="container-x py-12 max-w-2xl">
    <form method="POST" action="{{ route('booking.store') }}" class="space-y-6">
        @csrf

        <div>
            <label class="label" for="service_id">{{ __('Service') }}</label>
            <select name="service_id" id="service_id" class="field" required>
                <option value="">{{ __('Choose a service…') }}</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" @selected((string) old('service_id', $selectedService) === (string) $service->id)>
                        {{ $service->category?->name }} — {{ $service->name }} ({{ omr($service->price) }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="label" for="branch_id">{{ __('Branch') }}</label>
                <select name="branch_id" id="branch_id" class="field" required>
                    <option value="">{{ __('Choose a branch…') }}</option>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}" @selected(old('branch_id') == $branch->id)>{{ $branch->name }} — {{ $branch->city }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="label" for="staff_id">{{ __('Specialist') }} <span class="text-plum-700/50 font-normal">({{ __('optional') }})</span></label>
                <select name="staff_id" id="staff_id" class="field">
                    <option value="">{{ __('No preference') }}</option>
                    @foreach($staff as $member)
                        <option value="{{ $member->id }}" @selected(old('staff_id') == $member->id)>{{ $member->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="label" for="date">{{ __('Date') }}</label>
                <input type="date" name="date" id="date" class="field" required
                       min="{{ now()->toDateString() }}" value="{{ old('date', now()->addDay()->toDateString()) }}">
            </div>
            <div>
                <label class="label" for="time">{{ __('Time') }}</label>
                <select name="time" id="time" class="field" required>
                    @foreach($slots as $slot)
                        <option value="{{ $slot }}" @selected(old('time') === $slot)>{{ $slot }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <hr class="border-blush-200">

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="label" for="customer_name">{{ __('Full name') }}</label>
                <input type="text" name="customer_name" id="customer_name" class="field" required value="{{ old('customer_name') }}">
            </div>
            <div>
                <label class="label" for="customer_phone">{{ __('Phone') }}</label>
                <input type="tel" name="customer_phone" id="customer_phone" class="field" required dir="ltr" value="{{ old('customer_phone') }}">
            </div>
        </div>

        <div>
            <label class="label" for="customer_email">{{ __('Email') }} <span class="text-plum-700/50 font-normal">({{ __('optional') }})</span></label>
            <input type="email" name="customer_email" id="customer_email" class="field" dir="ltr" value="{{ old('customer_email') }}">
        </div>

        <div>
            <label class="label" for="notes">{{ __('Notes') }} <span class="text-plum-700/50 font-normal">({{ __('optional') }})</span></label>
            <textarea name="notes" id="notes" rows="3" class="field">{{ old('notes') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary w-full">{{ __('Confirm Booking') }}</button>
        <p class="text-xs text-plum-700/60 text-center">{{ __('By booking you agree to our salon policy. You can cancel by contacting the branch.') }}</p>
    </form>
</div>
@endsection
