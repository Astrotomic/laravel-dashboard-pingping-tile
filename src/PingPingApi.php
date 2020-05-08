<?php

namespace Astrotomic\PingPingTile;

use Illuminate\Support\Facades\Http;

class PingPingApi
{
    public function getMonitors(string $apiKey, array $monitorIds): array
    {
        return collect($monitorIds)
            ->map(fn (string $monitorId) => Http::get(sprintf('https://pingping.io/webapi/monitors/%s?api_key=%s', $monitorId, $apiKey))->json())
            ->toArray();
    }
}
