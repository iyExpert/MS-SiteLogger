<?php

namespace App\Repositories;

use App\Repositories\QueryFilters\BaseQueryFilterBuilder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * It's not classic repository pattern
 */
interface IQueriesRepository
{
    public function applyFilter();

    /**
     * Fetch absolute all results without limit by compose criteria.
     *
     * @param BaseQueryFilterBuilder $queryFilterBuilder
     *
     * @return EloquentCollection
     */
    public function fetchAll(BaseQueryFilterBuilder $queryFilterBuilder): EloquentCollection;

    /**
     * Fetch results by compose criteria.
     *
     * @param BaseQueryFilterBuilder $queryFilterBuilder
     * @param integer $limit the limit of results
     * @param integer $page the number page to offset results
     *
     * @return LengthAwarePaginator
     */
    public function filter(BaseQueryFilterBuilder $queryFilterBuilder, int $limit = 15, int $page = 1): LengthAwarePaginator;
}
