<?php

namespace Astrotomic\PingPingTile;

use Illuminate\Console\Command;

class FetchPingPingMonitorsCommand extends Command
{
    protected $signature = 'dashboard:fetch-pingping-monitors';
    protected $description = 'Fetch PingPing Monitors';

    public function handle(PingPingApi $pingPing): void
    {
        $this->info('Fetching PingPing monitors...');

        $monitors = $pingPing->getMonitors(
            config('dashboard.tiles.pingping.api_key'),
            config('dashboard.tiles.pingping.monitors')
        );

        PingPingStore::make()->setMonitors($monitors);

        $this->info('All done!');
    }
}
