<footer class="mt-24 bg-plum-900 text-cream-100">
    <div class="container-x py-14">
        <div class="grid gap-10 md:grid-cols-4">
            <div>
                <div class="font-serif text-2xl tracking-wide">AL ZAIN</div>
                <p class="mt-3 text-sm text-blush-200 leading-relaxed max-w-xs">
                    {{ __('A ladies salon and beauty house — bookings, skincare, facials and fashion, all in one place.') }}
                </p>
            </div>

            <div>
                <h4 class="text-sm font-semibold uppercase tracking-wider text-gold-400">{{ __('Salon') }}</h4>
                <ul class="mt-4 space-y-2 text-sm text-blush-200">
                    <li><a href="{{ route('services.index') }}" class="hover:text-cream-50">{{ __('All Services') }}</a></li>
                    <li><a href="{{ route('booking.create') }}" class="hover:text-cream-50">{{ __('Book an Appointment') }}</a></li>
                    @foreach($navServiceCategories->take(4) as $cat)
                        <li><a href="{{ route('services.index', ['category' => $cat->slug]) }}" class="hover:text-cream-50">{{ $cat->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4 class="text-sm font-semibold uppercase tracking-wider text-gold-400">{{ __('Shop') }}</h4>
                <ul class="mt-4 space-y-2 text-sm text-blush-200">
                    <li><a href="{{ route('shop.index') }}" class="hover:text-cream-50">{{ __('All Products') }}</a></li>
                    @foreach($navProductCategories->take(4) as $cat)
                        <li><a href="{{ route('shop.index', ['category' => $cat->slug]) }}" class="hover:text-cream-50">{{ $cat->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4 class="text-sm font-semibold uppercase tracking-wider text-gold-400">{{ __('Help') }}</h4>
                <ul class="mt-4 space-y-2 text-sm text-blush-200">
                    <li><a href="{{ route('about') }}" class="hover:text-cream-50">{{ __('About Us') }}</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-cream-50">{{ __('Contact') }}</a></li>
                    <li><a href="{{ route('policy', 'shipping-returns') }}" class="hover:text-cream-50">{{ __('Shipping & Returns') }}</a></li>
                    <li><a href="{{ route('policy', 'privacy') }}" class="hover:text-cream-50">{{ __('Privacy Policy') }}</a></li>
                    <li><a href="{{ route('policy', 'terms') }}" class="hover:text-cream-50">{{ __('Terms') }}</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-12 pt-6 border-t border-plum-700 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-blush-200">
            <p>&copy; {{ date('Y') }} Al Zain. {{ __('All rights reserved.') }}</p>
            <p>{{ __('Prices in Omani Rial (OMR). Muscat, Oman.') }}</p>
        </div>
    </div>
</footer>
