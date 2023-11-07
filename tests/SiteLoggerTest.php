<?php

namespace Tests;

use Illuminate\Support\Facades\DB;

class SiteLoggerTest extends TestCase
{
    /**
     * Ping SiteLogger Microservice Test
     *
     * @return void
     */
    public function testPing(): void
    {
        $this->get('/api/v1/ping')
            ->seeStatusCode(200)
            ->seeJson(['PONG: SiteLogger ping successfully']);
    }

    /**
     * Ping SiteLogger Microservice DB Test
     *
     * @return void
     */
    public function testPingDB(): void
    {
        $this->get('/api/v1/pingdb')
            ->seeStatusCode(200)
            ->seeJson(['SiteLogger PingDB successfully. Database: ' . DB::connection()->getDatabaseName()]);
    }
}
