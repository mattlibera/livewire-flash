<div>
    @if($shown)
    <div class="rounded-r-md bg-green-100 p-4 border-l-4 border-green-400 mb-3 relative overflow-hidden flashMessage">
        <div class="flex">
            <div class="flex-shrink-0">
                <p class="text-green-400">
                    {{-- Heroicon: check-circle --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </p>
            </div>
            <div class="ml-3 text-sm leading-5 font-medium text-green-800">
                {!! $message['message'] !!}
            </div>
            @if ($message['dismissable'] ?? false)
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button type="button" class="inline-flex rounded-md p-1.5 text-green-800 focus:outline-none transition ease-in-out duration-150" wire:click="dismiss">
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
                <div class="w-full bg-green-600 tickDown" style="animation-duration: {{ $message['dismissAfter'] + 0.1 }}s"></div>
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
