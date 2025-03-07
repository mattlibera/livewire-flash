<?php

namespace MattLibera\LivewireFlash;

use Livewire\Wireable;

class OverlayMessage extends Message implements Wireable
{
    /**
     * The title of the message.
     *
     * @var string
     */
    public $title = null;

    /**
     * Whether the message is an overlay.
     *
     * @var bool
     */
    public $overlay = true;

    public function toLivewire()
    {
        return [
            'title' => $this->title,
            'overlay' => $this->overlay,
        ];
    }
}
