<?php

namespace App\Repositories\QueryFilters\SiteLogger;

use App\Repositories\QueryFilters\BaseQueryFilter;

class TagsOrderId extends BaseQueryFilter
{
	/**
	 * @inheritDoc
	 */
	protected function applyParameter($builder)
	{
		return $builder->whereRaw([
			'tags' => [
				'$elemMatch' => [
					'entity' => 'orders',
					'id' => (int)request()->get($this->filterName())
				]
			]
		]);
	}
}
