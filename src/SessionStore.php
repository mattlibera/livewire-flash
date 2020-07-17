<?php

namespace MattLibera\LivewireFlash;

interface SessionStore
{
    /**
     * Flash a message to the session.
     *
     * @param string $name
     * @param array  $data
     */
    public function flash($name, $data);
}
