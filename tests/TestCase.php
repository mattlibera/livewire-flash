<?php

namespace MattLibera\LivewireFlash\Tests;

use Livewire\LivewireServiceProvider;
use MattLibera\LivewireFlash\LivewireFlashServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            LivewireServiceProvider::class,
            LivewireFlashServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        // Livewire uses the app key for HMAC checksums
        $app['config']->set('app.key', 'base64:' . base64_encode(random_bytes(32)));
    }
}
