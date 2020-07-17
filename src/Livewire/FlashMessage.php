<?php

namespace MattLibera\LivewireFlash\Livewire;

use Livewire\Component;

class FlashMessage extends Component
{
    public $message;

    public function mount($message)
    {
        if (!is_array($message)) {
            $message = (array) $message;
        }
        $this->message = $message;
    }

    public function render()
    {
        return view(config('livewire-flash.views.message'));
    }
}
