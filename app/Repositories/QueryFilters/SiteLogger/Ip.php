<?php

namespace App\Repositories\QueryFilters\SiteLogger;

use App\Repositories\QueryFilters\BaseQueryFilter;

class Ip extends BaseQueryFilter
{
	/**
	 * @inheritDoc
	 */
	protected function applyParameter($builder)
	{
        return $builder->where($this->filterName(), 'like', '%' . request()->get($this->filterName()) . '%');
	}
}
