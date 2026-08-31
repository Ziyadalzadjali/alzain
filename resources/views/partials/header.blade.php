@php($loc = app()->getLocale())
<header class="sticky top-0 z-40 bg-cream-50/95 backdrop-blur border-b border-blush-100">
    <div class="container-x">
        <div class="flex items-center justify-between h-16 gap-4">
            <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0">
                <span class="font-serif text-2xl tracking-wide text-plum-700">AL&nbsp;ZAIN</span>
                <span class="hidden sm:inline text-[0.6rem] tracking-[0.3em] text-rose-500 uppercase">{{ __('Salon & Beauty') }}</span>
            </a>

            <nav class="hidden lg:flex items-center gap-7 text-sm font-medium text-plum-900">
                <a href="{{ route('services.index') }}" class="hover:text-rose-500">{{ __('Salon Services') }}</a>
                <a href="{{ route('shop.index') }}" class="hover:text-rose-500">{{ __('Shop') }}</a>
                <a href="{{ route('shop.index', ['category' => 'skincare']) }}" class="hover:text-rose-500">{{ __('Skincare') }}</a>
                <a href="{{ route('shop.index', ['category' => 'fashion']) }}" class="hover:text-rose-500">{{ __('Fashion') }}</a>
                <a href="{{ route('about') }}" class="hover:text-rose-500">{{ __('About') }}</a>
                <a href="{{ route('contact') }}" class="hover:text-rose-500">{{ __('Contact') }}</a>
            </nav>

            <div class="flex items-center gap-3">
                <div class="hidden sm:flex items-center text-xs font-semibold rounded-full border border-blush-200 overflow-hidden">
                    <a href="{{ route('locale.switch', 'ar') }}" class="px-2.5 py-1 {{ $loc === 'ar' ? 'bg-plum-700 text-cream-50' : 'text-plum-700' }}">ع</a>
                    <a href="{{ route('locale.switch', 'en') }}" class="px-2.5 py-1 {{ $loc === 'en' ? 'bg-plum-700 text-cream-50' : 'text-plum-700' }}">EN</a>
                </div>

                <a href="{{ route('cart.index') }}" class="relative inline-flex items-center gap-1.5 text-sm font-medium text-plum-900 hover:text-rose-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-.502 1.756-1.686 1.756-3V6.741c0-.552-.448-1-1-1H5.106M7.5 14.25 5.106 5.741M7.5 14.25 6.106 18m0 0a1.125 1.125 0 1 0 2.25 0 1.125 1.125 0 0 0-2.25 0Zm11.25 0a1.125 1.125 0 1 0 2.25 0 1.125 1.125 0 0 0-2.25 0Z"/>
                    </svg>
                    <span class="hidden sm:inline">{{ __('Bag') }}</span>
                    @if($cart->count() > 0)
                        <span class="absolute -top-2 -end-2 bg-rose-500 text-cream-50 text-[0.65rem] font-bold rounded-full min-w-4 h-4 px-1 flex items-center justify-center">{{ $cart->count() }}</span>
                    @endif
                </a>

                <a href="{{ route('booking.create') }}" class="hidden md:inline-flex btn btn-primary !py-2 !px-4 text-xs">{{ __('Book Now') }}</a>

                <button type="button" data-toggle="#mobile-menu" class="lg:hidden text-plum-900" aria-label="Menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/>
                    </svg>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="hidden lg:hidden pb-4">
            <nav class="flex flex-col gap-1 text-sm font-medium text-plum-900">
                <a href="{{ route('services.index') }}" class="py-2 border-b border-blush-100">{{ __('Salon Services') }}</a>
                <a href="{{ route('shop.index') }}" class="py-2 border-b border-blush-100">{{ __('Shop') }}</a>
                <a href="{{ route('shop.index', ['category' => 'skincare']) }}" class="py-2 border-b border-blush-100">{{ __('Skincare') }}</a>
                <a href="{{ route('shop.index', ['category' => 'fashion']) }}" class="py-2 border-b border-blush-100">{{ __('Fashion') }}</a>
                <a href="{{ route('about') }}" class="py-2 border-b border-blush-100">{{ __('About') }}</a>
                <a href="{{ route('contact') }}" class="py-2 border-b border-blush-100">{{ __('Contact') }}</a>
                <a href="{{ route('booking.create') }}" class="btn btn-primary mt-3">{{ __('Book Now') }}</a>
                <div class="flex gap-2 mt-3">
                    <a href="{{ route('locale.switch', 'ar') }}" class="btn btn-outline flex-1 !py-2">العربية</a>
                    <a href="{{ route('locale.switch', 'en') }}" class="btn btn-outline flex-1 !py-2">English</a>
                </div>
            </nav>
        </div>
    </div>
</header>
