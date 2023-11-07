<?php

namespace App\Repositories\QueryFilters\SiteLogger;

use App\Repositories\QueryFilters\BaseQueryFilter;

class OrderId extends BaseQueryFilter
{
	/**
	 * @inheritDoc
	 */
	protected function applyParameter($builder)
	{
		return $builder->whereRaw(['tags.entity' => ['$eq' => 'orders'], 'tags.id' => ['$eq' => request()->get($this->filterName())]]);
	}
}
