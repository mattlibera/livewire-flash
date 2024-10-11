<?php

namespace MattLibera\LivewireFlash;

use Illuminate\Support\Traits\Macroable;
use Livewire\Component;

class LivewireFlashNotifier
{
    use Macroable;

    /**
     * The messages collection.
     *
     * @var \Illuminate\Support\Collection
     */
    public $messages;

    /**
     * The session store.
     *
     * @var SessionStore
     */
    protected $session;

    /**
     * Create a new FlashNotifier instance.
     */
    public function __construct(SessionStore $session)
    {
        $this->session = $session;
        $this->messages = collect();
    }

    /**
     * Magic __call: pass the method name called as the message type if it is configured.
     *
     * @param mixed $method
     * @param mixed $arguments
     *
     * @return \MattLibera\LivewireFlash\LivewireFlashNotifier
     */
    public function __call($method, $arguments)
    {
        $messageTypes = config('livewire-flash.styles');
        if (isset($messageTypes[$method])) {
            return $this->message(null, $method);
        }
    }

    /**
     * Flash a general message.
     *
     * @param null|string $message
     * @param null|string $level
     *
     * @return $this
     */
    public function message($message = null, $level = null)
    {
        // If no message was provided, we should update
        // the most recently added message.
        if (!$message) {
            return $this->updateLastMessage(compact('level'));
        }

        if (!$message instanceof Message) {
            $message = new Message(compact('message', 'level'));
        }

        $this->messages->push($message);

        return $this->flash();
    }

    /**
     * Flash an overlay modal.
     *
     * @param null|string $message
     * @param string      $title
     *
     * @return $this
     */
    public function overlay($message = null, $title = null)
    {
        if (!$message) {
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
    public function important()
    {
        return $this->updateLastMessage(['important' => true]);
    }

    /**
     * Set the dismissability of the last flash message.
     *
     * @return $this
     */
    public function dismissable(bool $dismissable = true)
    {
        return $this->updateLastMessage(['dismissable' => $dismissable]);
    }

    /**
     * Convenience method to set dismissable = false on a message.
     */
    public function notDismissable()
    {
        return $this->dismissable(false);
    }

    /**
     * Set an auto-dismiss interval on a message.
     *
     * @param bool|int $seconds
     *
     * @return $this
     */
    public function dismissAfter($seconds = false)
    {
        return $this->updateLastMessage(['dismissAfter' => $seconds]);
    }

    /**
     * Clear all registered messages.
     *
     * @return $this
     */
    public function clear()
    {
        $this->messages = collect();

        return $this;
    }

    /**
     * Pop the last message off the stack and emit it to the Livewire component.
     *
     * @param Livewire\Component $livewire
     *
     * @return \MattLibera\LivewireFlash\LivewireFlashNotifier
     */
    public function livewire(Component $livewire)
    {
        if (method_exists($livewire, 'dispatch')) {
            $livewire->dispatch('flashMessageAdded', $this->messages->pop());
        } else {
            $livewire->emit('flashMessageAdded', $this->messages->pop());
        }

        return $this;
    }

    /**
     * Modify the most recently added message.
     *
     * @param array $overrides
     *
     * @return $this
     */
    protected function updateLastMessage($overrides = [])
    {
        $this->messages->last()->update($overrides);

        return $this;
    }

    /**
     * Flash all messages to the session.
     */
    protected function flash()
    {
        $this->session->flash('flash_notification', $this->messages);

        return $this;
    }
}
