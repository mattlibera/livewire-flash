<?php

namespace MattLibera\LivewireFlash\Livewire;

use Livewire\Component;

class FlashMessage extends Component
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
    }

    public function render()
    {
        return view('livewire-flash::livewire.flash-message.'.$this->message['level']);
    }

    public function dismiss()
    {
        $this->shown = false;
    }
}
