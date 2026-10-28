<?php

namespace MattLibera\LivewireFlash\Livewire;

use Livewire\Attributes\Locked;
use Livewire\Component;
use MattLibera\LivewireFlash\Message;

class FlashContainer extends Component
{
    // Only the server adds or removes messages; Livewire v3+ rejects a
    // browser update to a locked property. (v2 ignores the attribute and
    // checksums the payload instead.)
    #[Locked]
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
        // Events can also be dispatched from the browser, so only a well-formed
        // message is kept; anything else would break the container's render.
        if ($message = $this->normalizeMessage($message)) {
            $this->messages[] = $message;
        }
    }

    public function dismissMessage($key)
    {
        unset($this->messages[$key]);
    }

    /**
     * A message as the plain array the views expect, or null if it isn't one.
     * It may arrive as a Message object or a plain array depending on Livewire version.
     */
    protected function normalizeMessage($message): ?array
    {
        if ($message instanceof Message) {
            return $message->toLivewire();
        }

        if (! is_array($message)) {
            return null;
        }

        $normalized = (new Message)->toLivewire();

        foreach ($normalized as $key => $default) {
            $value = $message[$key] ?? $default;

            if (get_debug_type($value) !== get_debug_type($default)) {
                return null;
            }

            $normalized[$key] = $value;
        }

        return $normalized;
    }
}
