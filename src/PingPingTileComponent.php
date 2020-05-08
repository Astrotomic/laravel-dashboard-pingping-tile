<?php

namespace Astrotomic\PingPingTile;

use Livewire\Component;

class PingPingTileComponent extends Component
{
    public string $position;

    public function mount(string $position)
    {
        $this->position = $position;
    }

    public function render()
    {
        return view('dashboard-pingping-tile::tile', [
            'monitors' => PingPingStore::make()->monitors(),
            'refreshIntervalInSeconds' => config('dashboard.tiles.pingping.refresh_interval_in_seconds', 60),
        ]);
    }
}
