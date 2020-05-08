<?php

namespace Astrotomic\PingPingTile;

use Illuminate\Support\Collection;
use Spatie\Dashboard\Models\Tile;

class PingPingStore
{
    private Tile $tile;

    public static function make()
    {
        return new static();
    }

    public function __construct()
    {
        $this->tile = Tile::firstOrCreateForName('pingping');
    }

    public function setMonitors(array $monitors): self
    {
        $this->tile->putData('monitors', $monitors);

        return $this;
    }

    public function monitors(): Collection
    {
        return collect($this->tile->getData('monitors') ?? [])
            ->map(fn (array $attributes) => new PingPingMonitor($attributes));
    }
}
