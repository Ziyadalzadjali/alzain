@if(session('status'))
    <div data-flash class="container-x pt-4">
        <div class="rounded-xl bg-blush-100 border border-blush-200 text-plum-700 px-4 py-3 text-sm flex items-center justify-between gap-4">
            <span>{{ session('status') }}</span>
            <button type="button" data-dismiss aria-label="{{ __('Dismiss') }}">&times;</button>
        </div>
    </div>
@endif

@if($errors->any())
    <div data-flash class="container-x pt-4">
        <div class="rounded-xl bg-rose-500/10 border border-rose-400 text-rose-500 px-4 py-3 text-sm">
            <ul class="list-disc {{ locale_dir() === 'rtl' ? 'pr-5' : 'pl-5' }} space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
