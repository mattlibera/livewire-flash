<?php


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
