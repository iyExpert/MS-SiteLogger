<?php

namespace App\Repositories\QueryFilters\SiteLogger;

use App\Repositories\QueryFilters\BaseQueryFilter;

class Search extends BaseQueryFilter
{
	/**
	 * @inheritDoc
	 */
	protected function applyParameter($builder)
	{
		return $builder->where(function ($query) {
            $query->where('title', 'like', '%' . request()->get($this->filterName()) . '%')
                ->orWhere('ip', 'like', '%' . request()->get($this->filterName()) . '%')
                ->orWhere('action', 'like', '%' . request()->get($this->filterName()) . '%')
                ->orWhere('user_name', 'like', '%' . request()->get($this->filterName()) . '%');
        });
	}
}
