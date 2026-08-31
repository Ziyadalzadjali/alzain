@props(['product'])
<div class="card flex flex-col">
    <a href="{{ route('shop.show', $product) }}" class="block relative">
        @if($product->main_image)
            <img src="{{ $product->main_image }}" alt="{{ $product->name }}" class="aspect-[4/5] w-full object-cover">
        @else
            <x-placeholder :label="$product->name" :seed="$product->id" class="aspect-[4/5]" />
        @endif
        @if($product->on_sale)
            <span class="absolute top-3 {{ locale_dir() === 'rtl' ? 'right-3' : 'left-3' }} bg-rose-500 text-cream-50 text-[0.65rem] font-bold uppercase tracking-wider px-2 py-1 rounded-full">{{ __('Sale') }}</span>
        @endif
    </a>
    <div class="p-4 flex flex-col flex-1">
        @if($product->brand)<span class="eyebrow">{{ $product->brand }}</span>@endif
        <a href="{{ route('shop.show', $product) }}" class="mt-1 text-base font-medium text-plum-900 hover:text-rose-500 line-clamp-2">{{ $product->name }}</a>
        <div class="mt-2 flex items-center gap-2 text-sm">
            <span class="font-semibold text-plum-700">{{ omr($product->current_price) }}</span>
            @if($product->on_sale)
                <span class="text-plum-700/50 line-through text-xs">{{ omr($product->price) }}</span>
            @endif
        </div>
        <form method="POST" action="{{ route('cart.add') }}" class="mt-3">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit" class="btn btn-outline w-full !py-2 text-xs" {{ $product->stock < 1 ? 'disabled' : '' }}>
                {{ $product->stock < 1 ? __('Sold Out') : __('Add to Bag') }}
            </button>
        </form>
    </div>
</div>
