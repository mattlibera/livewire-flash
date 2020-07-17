<?php

namespace MattLibera\LivewireFlash\Livewire;

use Livewire\Component;

class FlashContainer extends Component
{
    public $notifications = [];

    protected $listeners = ['flashMessageAdded'];

    public function mount()
    {
        // grab any normal flash messages and render them
        $this->notifications = session('flash_notification', collect())->toArray();
        session()->forget('flash_notification');
    }

    public function render()
    {
        return view(config('livewire-flash.views.container'));
    }

    public function flashMessageAdded($message)
    {
        $this->notifications = $message;
    }
}
