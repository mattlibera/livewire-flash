<section>
@foreach ($messages as $index => $message)
        @if ($message['overlay'])
            <livewire:flash-overlay :message="$message" :key="'lwfo_' . $index" />
        @else
            <livewire:flash-message :message="$message" :key="'lwfm_' . $index" />
        @endif
@endforeach
</section>
