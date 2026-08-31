@extends('layouts.app')
@section('title', $product->name . ' — Al Zain')

@section('content')
<div class="container-x py-10">
    <nav class="text-xs text-plum-700/60 mb-6">
        <a href="{{ route('shop.index') }}" class="hover:underline">{{ __('Shop') }}</a>
        <span class="mx-2">/</span>
        <a href="{{ route('shop.index', ['category' => $product->category?->slug]) }}" class="hover:underline">{{ $product->category?->name }}</a>
    </nav>

    <div class="grid lg:grid-cols-2 gap-10">
        <div class="grid grid-cols-2 gap-3">
            @php($imgs = $product->images ?? [])
            @if(count($imgs))
                @foreach(array_slice($imgs, 0, 4) as $i => $img)
                    <img src="{{ $img }}" alt="{{ $product->name }}" class="rounded-xl w-full object-cover aspect-square {{ $i === 0 ? 'col-span-2 aspect-[4/3]' : '' }}">
                @endforeach
            @else
                <x-placeholder :label="$product->name" :seed="$product->id" class="col-span-2 aspect-[4/3] rounded-2xl" />
            @endif
        </div>

        <div>
            @if($product->brand)<span class="eyebrow">{{ $product->brand }}</span>@endif
            <h1 class="mt-2 text-3xl md:text-4xl">{{ $product->name }}</h1>

            <div class="mt-4 flex items-center gap-3">
                <span class="text-2xl font-semibold text-plum-700">{{ omr($product->current_price) }}</span>
                @if($product->on_sale)
                    <span class="text-plum-700/50 line-through">{{ omr($product->price) }}</span>
                    <span class="text-xs bg-rose-500 text-cream-50 rounded-full px-2 py-0.5 font-semibold">{{ __('Sale') }}</span>
                @endif
            </div>

            <p class="mt-4 text-plum-700/85">{{ $product->short_description }}</p>

            <form method="POST" action="{{ route('cart.add') }}" class="mt-6 flex items-center gap-3">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="number" name="quantity" value="1" min="1" max="{{ max($product->stock, 1) }}" class="field w-20 !py-2">
                <button type="submit" class="btn btn-primary flex-1" {{ $product->stock < 1 ? 'disabled' : '' }}>
                    {{ $product->stock < 1 ? __('Sold Out') : __('Add to Bag') }}
                </button>
            </form>
            <p class="mt-2 text-xs text-plum-700/60">
                {{ $product->stock > 0 ? __(':n in stock', ['n' => $product->stock]) : __('Currently unavailable') }}
                · {{ __('Free delivery over :amount', ['amount' => omr(\App\Support\Cart::FREE_SHIPPING_FROM)]) }}
            </p>

            @if($product->description)
                <div class="mt-8 border-t border-blush-100 pt-6 text-sm text-plum-700/85 leading-relaxed">
                    <h3 class="font-semibold text-plum-700 mb-2">{{ __('Details') }}</h3>
                    {!! nl2br(e($product->description)) !!}
                </div>
            @endif
        </div>
    </div>

    @if($related->isNotEmpty())
        <section class="mt-20">
            <h2 class="text-2xl mb-8">{{ __('Pairs well with') }}</h2>
            <div class="grid gap-5 grid-cols-2 lg:grid-cols-4">
                @foreach($related as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
