<?php

namespace MattLibera\LivewireFlash\Livewire;

use Livewire\Component;
use MattLibera\LivewireFlash\Message;

class FlashContainer extends Component
{
    public array $messages = [];

    protected function getListeners(): array
    {
        // Livewire v3+ uses #[On] attributes; $listeners was removed in v4.
        // Return the array only on v2 so v3/v4 don't double-fire.
        return class_exists(\Livewire\Attributes\On::class) ? [] : ['flashMessageAdded'];
    }

    public function mount()
    {
        // grab any normal flash messages and render them, stored as plain arrays
        $this->messages = session('flash_notification', collect())
            ->map(fn (Message $m) => $m->toLivewire())
            ->values()
            ->toArray();
        session()->forget('flash_notification');
    }

    public function render()
    {
        return view(config('livewire-flash.views.container'));
    }

    #[\Livewire\Attributes\On('flashMessageAdded')]
    public function flashMessageAdded($message)
    {
        // $message may arrive as a Message object or plain array depending on Livewire version
        if ($message instanceof Message) {
            $message = $message->toLivewire();
        }

        $this->messages[] = $message;
    }

    public function dismissMessage($key)
    {
        unset($this->messages[$key]);
    }
}
