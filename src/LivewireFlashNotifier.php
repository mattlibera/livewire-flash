<?php

namespace MattLibera\LivewireFlash;

use Illuminate\Support\Collection;
use Livewire\Component;
use Illuminate\Support\Traits\Macroable;

class LivewireFlashNotifier
{
    use Macroable;

    /**
     * The session store.
     */
    protected SessionStore $session;

    public Collection $messages;

    /**
     * Create a new FlashNotifier instance.
     *
     * @param SessionStore $session
     */
    public function __construct(SessionStore $session)
    {
        $this->session = $session;
        $this->messages = collect();
    }

    /**
     * Flash a general message.
     */
    public function message(string $message = '', string $level = 'info'): self
    {
        // If no message was provided, we should update
        // the most recently added message.
        if (! $message) {
            return $this->updateLastMessage(compact('level'));
        }

        if (! $message instanceof Message) {
            $message = new Message(compact('message', 'level'));
        }

        $this->messages->push($message);

        return $this->flash();
    }

    /**
     * Modify the most recently added message.
     */
    protected function updateLastMessage(array $overrides = []): self
    {
        $this->messages->last()->update($overrides);

        return $this;
    }

    /**
     * Flash an overlay modal.
     */
    public function overlay($message = '', $title = ''): self
    {
        if (! $message) {
            return $this->updateLastMessage(['title' => $title, 'overlay' => true]);
        }

        return $this->message(
            new OverlayMessage(compact('title', 'message'))
        );
    }

    /**
     * Add an "important" flash to the session.
     *
     * @return $this
     */
    public function important(): self
    {
        return $this->updateLastMessage(['important' => true]);
    }

    /**
     * Set the dismissability of the last flash message.
     *
     * @param bool $dismissable
     *
     * @return $this
     */
    public function dismissable(bool $dismissable = true): self
    {
        return $this->updateLastMessage(['dismissable' => $dismissable]);
    }

    /**
     * Convenience method to set dismissable = false on a message
     *
     * @return void
     */
    public function notDismissable(): self
    {
        return $this->dismissable(false);
    }

    /**
     * Clear all registered messages.
     *
     * @return $this
     */
    public function clear(): self
    {
        $this->messages = collect();

        return $this;
    }

    /**
     * Flash all messages to the session.
     */
    protected function flash(): self
    {
        $this->session->flash('flash_notification', $this->messages);

        return $this;
    }

    /**
     * Pop the last message off the stack and emit it to the Livewire component
     */
    public function livewire(Component $livewire): self
    {
        if (method_exists($livewire, 'dispatch')) {
            $livewire->dispatch('flashMessageAdded', $this->messages->pop());
        } else {
            $livewire->emit('flashMessageAdded', $this->messages->pop());
        }

        return $this;
    }


    /**
     * Magic __call: pass the method name called as the message type if it is configured
     *
     * @param mixed $method
     * @param mixed $arguments
     * @return \MattLibera\LivewireFlash\LivewireFlashNotifier
     */
    public function __call($method, $arguments)
    {
        $messageTypes = config('livewire-flash.styles');
        if (isset($messageTypes[$method])) {
            return $this->message('', $method);
        }
    }
}
