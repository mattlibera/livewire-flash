<div>
    @if ($shown)
        <div class="{{ $styles['bg-color'] }} {{ $styles['border-color'] }} mb-3 rounded-r-md border-l-4 p-4">
            <div class="flex">
                @if ($iconset ?? false)
                    <div class="flex-shrink-0">
                        <p class="{{ $styles['icon-color'] }}">
                            @if ($iconset === 'fa')
                                <i class="{{ $styles['icon'][$iconset]['class'] }}"></i>
                            @elseif($iconset === 'blade')
                                @svg($styles['icon'][$iconset]['name'], $styles['icon'][$iconset]['class'])
                            @endif
                        </p>
                    </div>
                @endif
                <div class="{{ $styles['text-color'] }} ml-3 text-sm font-medium leading-5">
                    {!! $message['message'] !!}
                </div>
                @if ($iconset && ($message['dismissable'] ?? false))
                    <div class="ml-auto pl-3">
                        <div class="-mx-1.5 -my-1.5">
                            <button
                                class="{{ $styles['text-color'] }} inline-flex rounded-md p-1.5 transition duration-150 ease-in-out focus:outline-none"
                                wire:click="dismiss">
                                @if ($iconset === 'fa')
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
