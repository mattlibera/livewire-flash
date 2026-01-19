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
    public string $title = '';

    /**
     * Whether the message is an overlay.
     *
     * @var bool
     */
    public bool $overlay = true;

    public function toLivewire(): array
    {
        return array_merge(parent::toLivewire(),[
            'title' => $this->title,
            'overlay' => $this->overlay,
        ]);
    }
}
