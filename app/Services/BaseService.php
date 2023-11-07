<?php

namespace App\Services;

use App\Repositories\QueryFilters\BaseCriteriaBuilder;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

abstract class BaseService
{
    /**
     * Execute the query by builder and paginate into a simple paginator.
     *
     * @return LengthAwarePaginator the paginate results.
     */
    //abstract public function filter(): LengthAwarePaginator;

    /**
     * Save model with it's dependencies.
     *
     * @param Model $model the eloquent model.
     * @param array $attributes the fillable attributes.
     * @return Model the saved model.
     */
    abstract public function fullSave(Model $model, array $attributes): Model;

    /**
     * Fill attributes to eloquent model and simple it's save.
     *
     * @param Model $model the eloquent model.
     * @param array $attributes the fillable attributes.
     * @return Model the saved model.
     */
    abstract public function save(Model $model, array $attributes): Model;


    /**
     * Removing multiple models from a database with possible dependencies.
     *
     * @param array $ids list of identifiers for simultaneous removal of several models from the database with their possible dependencies.
     * @return mixed
     */
    abstract public function deleteMultiple(array $ids);
}
