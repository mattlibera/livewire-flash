<div>
    @if($shown)
    <div class="rounded-r-md {{ $styles['bg-color'] }} p-4 border-l-4 {{ $styles['border-color'] }} mb-3">
        <div class="flex">
            @if ($styles['icon'] ?? false)
                <div class="flex-shrink-0">
                    <p class="{{ $styles['icon-color'] }}">
                        @if($iconset === 'fa')
                        <i class="{{ $styles['icon'][$iconset]['class'] }}"></i>
                        @elseif($iconset === 'blade')
                        @svg($styles['icon'][$iconset]['name'], $styles['icon'][$iconset]['class'])
                        @endif
                    </p>
                </div>
            @endif
            <div class="ml-3 text-sm leading-5 font-medium {{ $styles['text-color'] }}">
                {!! $message['message'] !!}
            </div>
            @if ($message['dismissable'] ?? false)
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button class="inline-flex rounded-md p-1.5 {{ $styles['text-color'] }} focus:outline-none transition ease-in-out duration-150" wire:click="dismiss">
                    @if($iconset === 'fa')
                        <i class="{{ $dismiss[$iconset]['class'] }}"></i>
                        @elseif($iconset === 'blade')
                        @svg($dismiss[$iconset]['name'], $dismiss[$iconset]['class'])
                        @endif
                    </button>
                </div>
            </div>
            @endif
        </div>
    </div>
    @endif
</div>
