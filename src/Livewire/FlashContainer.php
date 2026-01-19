<?php

namespace MattLibera\LivewireFlash\Livewire;

use Livewire\Component;
use MattLibera\LivewireFlash\Message;
use MattLibera\LivewireFlash\OverlayMessage;

class FlashContainer extends Component
{
    public array $messages = [];

    protected $listeners = ['flashMessageAdded'];

    public function mount()
    {
        // grab any normal flash messages and render them
        $this->messages = session('flash_notification', collect())->toArray();
        session()->forget('flash_notification');
    }

    public function render()
    {
        return view(config('livewire-flash.views.container'));
    }

    public function flashMessageAdded($message)
    {
        $castedMessage = ($message['overlay'])
            ? OverlayMessage::fromLivewire($message)
            : Message::fromLivewire($message);

        $this->messages[] = $castedMessage;
    }

    public function dismissMessage($key)
    {
        unset($this->messages[$key]);
    }
}
