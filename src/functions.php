<?php

use Livewire\Component;

if (! function_exists('flash')) {

    /**
     * Arrange for a normal, session-based flash message.
     *
     * @param  string|null $message
     * @param  string      $level
     * @return \MattLibera\LivewireFlash\LivewireFlashNotifier
     */
    function flash($message = null, $level = 'info')
    {
        $notifier = app('lwflash');

        if (! is_null($message)) {
            return $notifier->message($message, $level);
        }

        return $notifier;
    }
}

if (! function_exists('lwflash')) {

    /**
     * Arrange for a livewire flash message.
     *
     * @param  Livewire\Component $livewire
     * @param  string|null $message
     * @param  string      $level
     * @return \MattLibera\LivewireFlash\LivewireFlashNotifier
     */
    function lwflash(Component $livewire, $message = null, $level = 'info')
    {
        $notifier = app('lwflash');

        if (! is_null($message)) {
            $notifier = $notifier->message($message, $level);

            // pop the message right back off the session and send a livewire event
            $flash = session('flash_notification', collect())->toArray();
            $livewire->emit('flashMessageAdded', $flash);

            return $notifier;
        }

        return $notifier;
    }
}
