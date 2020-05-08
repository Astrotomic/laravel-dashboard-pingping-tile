<?php

namespace Astrotomic\PingPingTile\Tests;

use Astrotomic\PingPingTile\PingPingMonitor;
use Carbon\Carbon;
use Orchestra\Testbench\TestCase;

class PingPingMonitorTest extends TestCase
{
    /** @test */
    public function it_handles_up_and_secure_monitor(): void
    {
        $monitor = new PingPingMonitor([
            'alias' => 'example.com',
            'checks' => [
                'uptime' => [
                    'status' => 'ok',
                ],
                'certificate_health' => [
                    'status' => 'ok',
                    'meta' => [
                        'valid_to' => now()->addMonth()->format('Y-m-d H:i:s'),
                    ],
                ],
            ],
        ]);

        $this->assertSame('example.com', $monitor->name());
        $this->assertTrue($monitor->isUp());
        $this->assertTrue($monitor->isSecure());
        $this->assertInstanceOf(Carbon::class, $monitor->validTo());
        $this->assertSame('up', $monitor->uptimeState());
        $this->assertSame('valid', $monitor->sslState());
    }

    /** @test */
    public function it_handles_down_and_insecure_monitor(): void
    {
        $monitor = new PingPingMonitor([
            'alias' => 'example.com',
            'checks' => [
                'uptime' => [
                    'status' => 'error',
                ],
                'certificate_health' => [
                    'status' => 'error',
                    'meta' => [
                        'valid_to' => now()->subWeek()->format('Y-m-d H:i:s'),
                    ],
                ],
            ],
        ]);

        $this->assertSame('example.com', $monitor->name());
        $this->assertFalse($monitor->isUp());
        $this->assertFalse($monitor->isSecure());
        $this->assertSame('down', $monitor->uptimeState());
        $this->assertSame('invalid', $monitor->sslState());
    }

    /** @test */
    public function it_handles_up_and_valid_less_than_week_monitor(): void
    {
        $monitor = new PingPingMonitor([
            'alias' => 'example.com',
            'checks' => [
                'uptime' => [
                    'status' => 'ok',
                ],
                'certificate_health' => [
                    'status' => 'ok',
                    'meta' => [
                        'valid_to' => now()->addDays(3)->format('Y-m-d H:i:s'),
                    ],
                ],
            ],
        ]);

        $this->assertSame('example.com', $monitor->name());
        $this->assertTrue($monitor->isUp());
        $this->assertTrue($monitor->isSecure());
        $this->assertSame('up', $monitor->uptimeState());
        $this->assertSame('3 days', $monitor->sslState());
    }
}
