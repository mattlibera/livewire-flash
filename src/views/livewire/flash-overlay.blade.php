<div>
    @if($shown)
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!--
                  Background overlay, show/hide based on modal state.

                  Entering: "ease-out duration-300"
                    From: "opacity-0"
                    To: "opacity-100"
                  Leaving: "ease-in duration-200"
                    From: "opacity-100"
                    To: "opacity-0"
                -->
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 {{ $styles['overly-bg-color'] }} {{ $styles['overlay-bg-opacity'] }}"></div>
                </div>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <!--
                  Modal panel, show/hide based on modal state.

                  Entering: "ease-out duration-300"
                    From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    To: "opacity-100 translate-y-0 sm:scale-100"
                  Leaving: "ease-in duration-200"
                    From: "opacity-100 translate-y-0 sm:scale-100"
                    To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                -->
                <div class="inline-block relative align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <div class="sm:block absolute top-0 right-0 pt-4 pr-4">
                        <button wire:click="dismiss" type="button" class="text-gray-300 bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span class="sr-only">Close</span>
                            <!-- Heroicon name: x -->
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div>
                        <div class="mt-3 text-center sm:mt-5">
                            @if($message['title'])
                                <h3 class="text-lg leading-6 font-medium {{ $styles['title-text-color'] }}" id="modal-headline">
                                    {!! $message['title'] !!}
                                </h3>
                            @endif
                            <div class="mt-2">
                                <p class="text-sm {{ $styles['body-text-color'] }}">
                                    {!! $message['message'] !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-6">
                        <button wire:click="dismiss" type="button" class="inline-flex justify-center w-full rounded-md border {{ $styles['button-border-color'] }} shadow-sm px-4 py-2 {{ $styles['button-bg-color'] }} text-base font-medium {{ $styles['button-text-color'] }} {{ $styles['button-hover-bg-color'] }} {{ $styles['button-hover-text-color'] }} focus:outline-none focus:ring-2 focus:ring-offset-2 {{ $styles['button-focus-ring-color'] }} sm:text-sm {{ $styles['button-extra-classes'] }}">
                            {{ $styles['button-text'] }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
