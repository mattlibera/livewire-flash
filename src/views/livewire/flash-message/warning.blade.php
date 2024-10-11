<div>
    @if($shown)
    <div class="rounded-r-md bg-yellow-100 p-4 border-l-4 border-yellow-400 mb-3 relative flashMessage">
        <div class="flex">
            <div class="flex-shrink-0">
                <p class="text-yellow-400">
                    {{-- Heroicon: exclamation --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </p>
            </div>
            <div class="ml-3 text-sm leading-5 font-medium text-yellow-800">
                {!! $message['message'] !!}
            </div>
            @if ($message['dismissable'] ?? false)
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button type="button" class="inline-flex rounded-md p-1.5 text-yellow-800 focus:outline-none transition ease-in-out duration-150" wire:click="dismiss">
                        {{-- Heroicon: x --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            @endif
        </div>
        @if ($message['dismissAfter'])
            <div class="w-full overflow-hidden bottom-0 left-0 absolute">
                <div class="w-full bg-yellow-600 tickDown" style="animation-duration: {{ $message['dismissAfter'] + 0.1 }}s"></div>
            </div>
            <script>
                window.onload = function () {
                    const timer = new Timer(function() {
                        @this.dismiss()
                    }, {{ $message['dismissAfter'] * 1000 }})
                }
            </script>
        @endif
    </div>
    @endif
</div>
