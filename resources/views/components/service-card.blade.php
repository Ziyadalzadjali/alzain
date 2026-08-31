@props(['service'])
<a href="{{ route('services.show', $service) }}" class="card flex flex-col">
    @if($service->image)
        <img src="{{ $service->image }}" alt="{{ $service->name }}" class="aspect-[4/3] w-full object-cover">
    @else
        <x-placeholder :label="$service->name" :seed="$service->id" class="aspect-[4/3]" />
    @endif
    <div class="p-5 flex flex-col flex-1">
        <span class="eyebrow">{{ $service->category?->name }}</span>
        <h3 class="mt-1 text-xl">{{ $service->name }}</h3>
        <p class="mt-2 text-sm text-plum-700/80 line-clamp-2 flex-1">{{ \Illuminate\Support\Str::limit(strip_tags($service->description), 110) }}</p>
        <div class="mt-4 flex items-center justify-between text-sm">
            <span class="font-semibold text-plum-700">{{ omr($service->price) }}</span>
            <span class="text-plum-700/60">{{ $service->duration_minutes }} {{ __('min') }}</span>
        </div>
    </div>
</a>
