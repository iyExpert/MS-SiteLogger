<?php

namespace App\Services;

use App\Models\SiteLogger;
use App\Repositories\QueryFilters\BaseQueryFilterBuilder;
use App\Repositories\SiteLoggerRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class SiteLoggerService extends BaseService
{
    public function getItem(string $_id): SiteLogger
    {
        $repository = new SiteLoggerRepository();
        return $repository->getOrFail($_id);
    }

    public function filter(BaseQueryFilterBuilder $qb): LengthAwarePaginator
    {
        $repository = new SiteLoggerRepository();
        return $repository->filter($qb, $qb->limit(), $qb->page());
    }

    public function fullSave(Model $model, array $attributes): Model
    {
        return $this->save($model, $attributes);
    }

    public function save(Model $model, array $attributes): Model
    {
        $model->fill($attributes);
        $model->save();
        return $model;
    }

    public function deleteMultiple(array $ids)
    {
        SiteLogger::destroy($ids);
    }
}
