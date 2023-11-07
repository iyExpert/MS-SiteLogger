<?php

namespace App\Repositories\QueryFilters\Base;

use App\Repositories\QueryFilters\BaseQueryFilter;

/**
 * Base criteria for sort items.
 *
 * @package App\Repositories\Criteria\Base
 */
class orderByColumn extends BaseQueryFilter
{
    public bool $isRequired = true;

    /**
     * Adds 'ORDER BY' to query builder.
     *
     * @param $builder
     * @return mixed
     */
    protected function applyParameter($builder): mixed
    {
        $column = request()->has('orderByColumn') ? request()->get('orderByColumn') : '_id';
        $dir = request()->has('orderByMethod') ? request()->get('orderByMethod') : 'desc';

        return $builder->orderBy($column, $dir);
    }
}
