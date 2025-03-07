<?php

namespace MattLibera\LivewireFlash\Livewire;

use Livewire\Component;
use MattLibera\LivewireFlash\OverlayMessage;

class FlashOverlay extends Component
{
    public OverlayMessage $message;
    public array $styles = [];

    public bool $shown = true;

    public function mount($message)
    {
        $this->message = $message;
        $this->styles = config('livewire-flash.styles.overlay');
    }

    public function render()
    {
        return view(config('livewire-flash.views.overlay'));
    }

    public function dismiss()
    {
        $this->shown = false;
    }
}
