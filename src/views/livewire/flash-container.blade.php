<section>
    @foreach ($messages as $index => $message)
        @if ($message['overlay'])
            <livewire:flash-overlay :message="$message" :key="'lwfo_' . $index" />
        @else
            <livewire:flash-message :message="$message" :key="'lwfm_' . $index" />
        @endif
    @endforeach

    @if (! $message['overlay'])
        <script>
            var Timer = function(callback, delay) {
                var timerId, start, remaining = delay;

                this.pause = function() {
                    window.clearTimeout(timerId);
                    remaining -= Date.now() - start;
                };

                this.resume = function() {
                    start = Date.now();
                    window.clearTimeout(timerId);
                    timerId = window.setTimeout(callback, remaining);
                };

                // attach event listeners here
                var messageElement = document.getElementsByClassName('flashMessage')[0];
                messageElement.addEventListener('mouseenter', pause => this.pause())
                messageElement.addEventListener('mouseleave', resume => this.resume())

                this.resume();
            };

        </script>
        <style>
            @keyframes tickDown {
                0% { transform: translateX(0%); }
                100% { transform: translateX(100%); }
            }
            .flashMessage .tickDown {
                height: 5px;
                animation-name: tickDown;
                animation-timing-function: ease-out;
                animation-iteration-count: 1;
                animation-delay: 0s;
            }
            .flashMessage:hover .tickDown {
                animation-play-state: paused;
            }
        </style>
    @endif
</section>
