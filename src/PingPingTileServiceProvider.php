<?php

namespace Astrotomic\PingPingTile;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class PingPingTileServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                FetchPingPingMonitorsCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/dashboard-pingping-tile'),
        ], 'dashboard-pingping-tile-views');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dashboard-pingping-tile');

        Livewire::component('pingping-tile', PingPingTileComponent::class);
    }
}
