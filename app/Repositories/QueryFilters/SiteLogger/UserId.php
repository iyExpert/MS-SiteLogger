<?php

namespace App\Repositories\QueryFilters\SiteLogger;

use App\Repositories\QueryFilters\BaseQueryFilter;

class UserId extends BaseQueryFilter
{
	/**
	 * @inheritDoc
	 */
	protected function applyParameter($builder)
	{
		return $builder->where($this->filterName(), request()->get($this->filterName()));
	}
}
