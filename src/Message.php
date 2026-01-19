<?php

namespace MattLibera\LivewireFlash;

use InvalidArgumentException;
use Livewire\Wireable;

class Message implements \ArrayAccess, Wireable
{
    /**
     * The title of the message.
     *
     * @var string
     */
    public string $title = '';

    /**
     * The body of the message.
     *
     * @var string
     */
    public string $message = '';

    /**
     * The message level.
     *
     * @var string
     */
    public string $level = 'info';

    /**
     * Whether the message should auto-hide.
     *
     * @var bool
     */
    public bool $important = false;

    /**
     * Whether the message is dismissable.
     *
     * @var bool
     */
    public bool $dismissable = true;

    /**
     * Whether the message is an overlay.
     *
     * @var bool
     */
    public bool $overlay = false;

    /**
     * Create a new message instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->update($attributes);
    }

    /**
     * Update the attributes.
     *
     * @param  array $attributes
     * @return $this
     */
    public function update(array $attributes = [])
    {
        foreach ($attributes as $key => $attribute) {
            $this->$key = $attribute;
        }
        return $this;
    }


    /**
     * Whether the given offset exists.
     *
     * @param  mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }

    /**
     * Fetch the offset.
     *
     * @param  mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    /**
     * Assign the offset.
     *
     * @param  mixed $offset
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }

    /**
     * Unset the offset.
     *
     * @param  mixed $offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        //
    }

    public function toLivewire(): array
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'level' => $this->level,
            'important' => $this->important,
            'dismissable' => $this->dismissable,
            'overlay' => $this->overlay,
        ];
    }

    public static function fromLivewire($value)
    {
        if ($value instanceof static) {
            return $value;
        }
        if (!is_array($value)) {
            throw new InvalidArgumentException(static::class . '::fromLivewire expects an array or instance.');
        }

        return new static ($value);
    }
}
