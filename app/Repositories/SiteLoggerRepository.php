<?php

namespace App\Repositories;

use App\Models\SiteLogger;

class SiteLoggerRepository extends BaseQueriesRepository
{
    public function getModelName(): string {
        return SiteLogger::class;
    }
}
