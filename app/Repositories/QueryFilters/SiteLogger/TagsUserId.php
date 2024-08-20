<?php

namespace App\Repositories\QueryFilters\SiteLogger;

use App\Repositories\QueryFilters\BaseQueryFilter;

class TagsUserId extends BaseQueryFilter
{
	/**
	 * @inheritDoc
	 */
	protected function applyParameter($builder)
	{
		return $builder->whereRaw([
			'tags' => [
				'$elemMatch' => [
					'entity' => 'users',
					'id' => (int)request()->get($this->filterName())
				]
			]
		]);
	}
}
