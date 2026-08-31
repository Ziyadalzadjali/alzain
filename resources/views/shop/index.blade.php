@extends('layouts.app')
@section('title', __('Shop') . ' — Al Zain')

@section('content')
<section class="bg-blush-100/50">
    <div class="container-x py-14">
        <span class="eyebrow">{{ __('The Al Zain Shop') }}</span>
        <h1 class="mt-2 text-4xl md:text-5xl">{{ __('Skincare, Facials & Fashion') }}</h1>
        <p class="mt-3 text-plum-700/80 max-w-xl">{{ __('Everything we use and love in the salon — ready to take home.') }}</p>
    </div>
</section>

<div class="container-x py-10 grid lg:grid-cols-[220px_1fr] gap-10">
    {{-- Sidebar --}}
    <aside class="space-y-6">
        <div>
            <h3 class="text-sm font-semibold uppercase tracking-wider text-plum-700 mb-3">{{ __('Categories') }}</h3>
            <ul class="space-y-1 text-sm">
                <li><a href="{{ route('shop.index') }}" class="{{ ! $activeCategory ? 'text-rose-500 font-semibold' : 'text-plum-700/80 hover:text-rose-500' }}">{{ __('All products') }}</a></li>
                @foreach($categories as $cat)
                    <li><a href="{{ route('shop.index', ['category' => $cat->slug]) }}" class="{{ $activeCategory === $cat->slug ? 'text-rose-500 font-semibold' : 'text-plum-700/80 hover:text-rose-500' }}">{{ $cat->name }}</a></li>
                @endforeach
            </ul>
        </div>
        <form method="GET" action="{{ route('shop.index') }}" class="space-y-2">
            @if($activeCategory)<input type="hidden" name="category" value="{{ $activeCategory }}">@endif
            <input type="search" name="q" value="{{ $search }}" placeholder="{{ __('Search products…') }}" class="field !py-2 text-sm">
        </form>
    </aside>

    {{-- Grid --}}
    <div>
        <div class="flex items-center justify-between mb-6">
            <p class="text-sm text-plum-700/60">{{ $products->total() }} {{ __('products') }}</p>
            <form method="GET" action="{{ route('shop.index') }}">
                @if($activeCategory)<input type="hidden" name="category" value="{{ $activeCategory }}">@endif
                @if($search)<input type="hidden" name="q" value="{{ $search }}">@endif
                <select name="sort" class="field !py-2 text-sm w-auto" onchange="this.form.submit()">
                    <option value="">{{ __('Sort: Featured') }}</option>
                    <option value="newest" @selected($sort==='newest')>{{ __('Newest') }}</option>
                    <option value="price_asc" @selected($sort==='price_asc')>{{ __('Price: Low to High') }}</option>
                    <option value="price_desc" @selected($sort==='price_desc')>{{ __('Price: High to Low') }}</option>
                </select>
            </form>
        </div>

        @if($products->isEmpty())
            <p class="text-plum-700/60 py-16 text-center">{{ __('No products match your search.') }}</p>
        @else
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
            <div class="mt-10">{{ $products->links() }}</div>
        @endif
    </div>
</div>
@endsection
