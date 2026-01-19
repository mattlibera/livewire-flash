<?php

namespace MattLibera\LivewireFlash\Livewire;

use Livewire\Component;
use MattLibera\LivewireFlash\Message;

class FlashMessage extends Component
{
    public Message $message;
    public array $styles = [];

    public $shown = true;

    public function mount(Message $message)
    {
        $this->message = $message;
        $this->styles = config('livewire-flash.styles.' . $this->message['level']);
    }

    public function render()
    {
        return view(config('livewire-flash.views.message'));
    }

    public function dismiss()
    {
        $this->shown = false;
    }
}
