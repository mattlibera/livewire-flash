<section>
@foreach ($messages as $index => $message)
    <livewire:flash-message :message="$message" :key="'lwfm_' . $index" />
@endforeach
</section>
