<?php

namespace App\Repositories\QueryFilters\SiteLogger;

use App\Repositories\QueryFilters\BaseQueryFilter;

class DateTo extends BaseQueryFilter
{
	/**
	 * @inheritDoc
	 */
	protected function applyParameter($builder)
	{
		return $builder->where('date', '<=', request()->get($this->filterName()));
	}
}
