<?php

namespace MattLibera\LivewireFlash\Livewire;

use Livewire\Component;

class FlashOverlay extends Component
{
    public $message;
    public $styles = [];

    public $shown = true;

    public function mount($message)
    {
        if (!is_array($message)) {
            $message = (array) $message;
        }
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
