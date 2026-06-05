<?php

namespace MattLibera\LivewireFlash;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;

class LivewireFlashServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'MattLibera\LivewireFlash\SessionStore',
            'MattLibera\LivewireFlash\LaravelSessionStore'
        );

        $this->app->singleton('lwflash', function () {
            return $this->app->make('MattLibera\LivewireFlash\LivewireFlashNotifier');
        });
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__. '/publish/livewire-flash.php', 'livewire-flash');

        $this->loadViewsFrom(__DIR__ . '/views', 'livewire-flash');

        $this->publishes([
            __DIR__ . '/publish' => config_path()
        ]);

        Livewire::component('flash-container', \MattLibera\LivewireFlash\Livewire\FlashContainer::class);
        Livewire::component('flash-message', \MattLibera\LivewireFlash\Livewire\FlashMessage::class);
        Livewire::component('flash-overlay', \MattLibera\LivewireFlash\Livewire\FlashOverlay::class);
    }
}
