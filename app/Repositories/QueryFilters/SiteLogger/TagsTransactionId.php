<?php

namespace App\Repositories\QueryFilters\SiteLogger;

use App\Repositories\QueryFilters\BaseQueryFilter;

class TagsTransactionId extends BaseQueryFilter
{
	/**
	 * @inheritDoc
	 */
	protected function applyParameter($builder)
	{
		return $builder->whereRaw([
			'tags' => [
				'$elemMatch' => [
					'entity' => 'transactions',
					'id' => (int)request()->get($this->filterName())
				]
			]
		]);
	}
}
