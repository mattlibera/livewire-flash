<?php

namespace MattLibera\LivewireFlash\Livewire;

use Livewire\Attributes\Locked;
use Livewire\Component;
use MattLibera\LivewireFlash\Message;

class FlashMessage extends Component
{
    #[Locked]
    public $message;

    #[Locked]
    public array $styles = [];

    public bool $shown = true;

    public function mount($message)
    {
        $this->message = $message instanceof Message ? $message->toLivewire() : $message;
        $this->styles = config('livewire-flash.styles.' . data_get($this->message, 'level'));
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
