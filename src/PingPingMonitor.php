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

    public function uptimeState(): string
    {
        if ($this->isUp()) {
            return 'up';
        }

        return 'down';
    }

    public function uptimeDisplayClass(): string
    {
        if ($this->isSecure()) {
            return 'text-green-600 bg-green-200 border-green-600';
        }

        return 'text-red-600 bg-red-200 border-red-600';
    }

    public function sslState(): string
    {
        if (! $this->isSecure()) {
            return 'invalid';
        }

        if(now()->addWeek()->isAfter($this->validTo())) {
            return now()->diffInDays($this->validTo()).' days';
        }

        return 'valid';
    }

    public function sslDisplayClass(): string
    {
        if (! $this->isSecure()) {
            return 'text-red-600 bg-red-200 border-red-600';
        }

        if(now()->addWeek()->isAfter($this->validTo())) {
            return 'text-yellow-600 bg-yellow-200 border-yellow-600';
        }

        return 'text-green-600 bg-green-200 border-green-600';
    }
}
