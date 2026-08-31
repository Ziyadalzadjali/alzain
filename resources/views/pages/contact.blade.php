@extends('layouts.app')
@section('title', __('Contact') . ' — Al Zain')

@section('content')
<div class="container-x py-14 grid lg:grid-cols-2 gap-12">
    <div>
        <span class="eyebrow">{{ __('Get in touch') }}</span>
        <h1 class="mt-2 text-4xl md:text-5xl">{{ __('Contact Al Zain') }}</h1>
        <p class="mt-4 text-plum-700/80">{{ __('Questions about a booking, an order, or a product? Send us a message and we will reply within one business day.') }}</p>

        <div class="mt-8 space-y-5">
            @foreach($branches as $branch)
                <div class="card p-5">
                    <h3 class="text-lg">{{ $branch->name }}</h3>
                    <p class="text-sm text-plum-700/80 mt-1">{{ $branch->address }}, {{ $branch->city }}</p>
                    @if($branch->phone)<p class="text-sm font-medium mt-1" dir="ltr">{{ $branch->phone }}</p>@endif
                    @if($branch->whatsapp)<p class="text-sm text-rose-500 mt-1" dir="ltr">WhatsApp: {{ $branch->whatsapp }}</p>@endif
                </div>
            @endforeach
        </div>
    </div>

    <form method="POST" action="{{ route('contact.store') }}" class="card p-6 space-y-4 h-fit">
        @csrf
        <div>
            <label class="label" for="name">{{ __('Your name') }}</label>
            <input type="text" name="name" id="name" class="field" required value="{{ old('name') }}">
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="label" for="email">{{ __('Email') }}</label>
                <input type="email" name="email" id="email" class="field" dir="ltr" value="{{ old('email') }}">
            </div>
            <div>
                <label class="label" for="phone">{{ __('Phone') }}</label>
                <input type="tel" name="phone" id="phone" class="field" dir="ltr" value="{{ old('phone') }}">
            </div>
        </div>
        <div>
            <label class="label" for="subject">{{ __('Subject') }}</label>
            <input type="text" name="subject" id="subject" class="field" value="{{ old('subject') }}">
        </div>
        <div>
            <label class="label" for="message">{{ __('Message') }}</label>
            <textarea name="message" id="message" rows="5" class="field" required>{{ old('message') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary w-full">{{ __('Send Message') }}</button>
    </form>
</div>
@endsection
