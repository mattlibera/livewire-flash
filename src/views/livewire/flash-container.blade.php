<section>
@foreach ($notifications as $message)
    <livewire:flash-message :message="$message" wire:key="lwfm_{{ $loop->index }}" />
@endforeach
</section>
