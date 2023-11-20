<?php

namespace App\Repositories;

use App\Repositories\QueryFilters\BaseQueryFilterBuilder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Pipeline\Pipeline;

abstract class BaseQueriesRepository implements IQueriesRepository
{
    public function applyFilter($queryParameters = [])
    {
        $model = $this->getModelName();

        return app(Pipeline::class)
            ->send($model::query())
            ->through($queryParameters)
            ->thenReturn();
    }

    public function getOrFail(string $_id)
    {
        return $this->getModelName()::findOrFail($_id);
    }

    public function fetchAll(BaseQueryFilterBuilder $queryFilterBuilder): EloquentCollection
    {
        return $this->applyFilter($queryFilterBuilder->getListParameters())->get();
    }

    public function filter(BaseQueryFilterBuilder $queryFilterBuilder, int $limit = 15, int $page = 1): LengthAwarePaginator
    {
        Paginator::currentPageResolver(function () use ($page) { //set page
            return $page;
        });

        return $this->applyFilter($queryFilterBuilder->getListParameters())->paginate($limit);
    }
}
