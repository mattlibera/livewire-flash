<?php

namespace MattLibera\LivewireFlash\Livewire;

use Livewire\Component;

class FlashContainer extends Component
{
    public $messages = [];

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
        $this->messages[] = $message;
    }

    public function dismissMessage($key)
    {
        unset($this->messages[$key]);
    }
}
