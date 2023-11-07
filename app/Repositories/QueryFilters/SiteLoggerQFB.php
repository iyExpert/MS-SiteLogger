<?php

namespace App\Repositories\QueryFilters;

use App\Repositories\QueryFilters\Base\orderByColumn;
use App\Repositories\QueryFilters\SiteLogger\Action;
use App\Repositories\QueryFilters\SiteLogger\DateFrom;
use App\Repositories\QueryFilters\SiteLogger\DateTo;
use App\Repositories\QueryFilters\SiteLogger\Ip;
use App\Repositories\QueryFilters\SiteLogger\OrderId;
use App\Repositories\QueryFilters\SiteLogger\Title;
use App\Repositories\QueryFilters\SiteLogger\Type;
use App\Repositories\QueryFilters\SiteLogger\UserId;

/**
 * SiteLogger Query Filter Builder.
 *
 * @package App\Criteria
 */
class SiteLoggerQFB extends BaseQueryFilterBuilder
{

    /**
     * List of one criteria for filtering.
     *
     * @return array
     */
    public function getListParameters(): array
    {
        return [
            Title::class,
            Type::class,
            Ip::class,
            OrderId::class,
            Action::class,
            UserId::class,
            DateFrom::class,
            DateTo::class,
            orderByColumn::class,
        ];
    }
}
