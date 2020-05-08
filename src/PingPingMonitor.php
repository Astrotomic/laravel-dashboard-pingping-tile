<?php

namespace Astrotomic\PingPingTile;

use Carbon\Carbon;

class PingPingMonitor
{
    protected array $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function name(): string
    {
        return $this->attributes['alias'];
    }

    public function avgUptime(): float
    {
        return $this->attributes['checks']['uptime']['meta']['average_uptime_percentage'];
    }

    public function avgResponseTime(): float
    {
        return $this->attributes['checks']['uptime']['meta']['average_response_time'] * 1000;
    }

    public function isUp(): bool
    {
        return $this->attributes['checks']['uptime']['status'] === 'ok';
    }

    public function isSecure(): bool
    {
        return $this->attributes['checks']['certificate_health']['status'] === 'ok';
    }

    public function validTo(): Carbon
    {
        return Carbon::parse($this->attributes['checks']['certificate_health']['meta']['valid_to']);
    }
}
