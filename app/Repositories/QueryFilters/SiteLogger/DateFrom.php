<?php

namespace App\Repositories\QueryFilters\SiteLogger;

use App\Repositories\QueryFilters\BaseQueryFilter;
use Carbon\Carbon;
use MongoDB\BSON\UTCDateTime;

class DateFrom extends BaseQueryFilter
{
	/**
	 * @inheritDoc
	 */
	protected function applyParameter($builder)
	{
        $date = Carbon::createFromFormat('Y-m-d', request()->get($this->filterName()))->format('Y-m-d 00:00:00.000');
        return $builder->where('date', '>=', new UTCDateTime((strtotime($date) . '000')));
	}
}
