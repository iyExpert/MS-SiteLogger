<?php

namespace App\Repositories\QueryFilters;

use Closure;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Str;

/**
 * Building a query based on a list of criteria filtered based on the query.
 *
 * @package App\Repositories\QueryFilters
 */
abstract class BaseQueryFilter
{
    /**
     * Apply a filter even if there is no get parameter
     *
     * @var bool
     */
    public bool $isRequired = false;

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!request()->has($this->filterName()) AND !$this->isRequired) {
            return $next($request);
        }

        $builder = $next($request);

        return $this->applyParameter($builder);
    }

    /**
     * @param $builder
     */
    protected abstract function applyParameter($builder);

    /**
     * @return string
     */
    protected function filterName(): string
    {
        return Str::snake(class_basename($this));
    }
}
