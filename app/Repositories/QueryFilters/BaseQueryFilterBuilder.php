<?php

namespace App\Repositories\QueryFilters;

use Illuminate\Http\Request;

/**
 * Building a query based on a list of criteria filtered based on the query.
 *
 * @package App\Repositories\QueryFilters
 */
abstract class BaseQueryFilterBuilder
{
    protected $request;

    public function __construct(Request $request = null)
    {
        $this->request = $request ?: \request();
    }

    /**
     * Getter for Request object.
     *
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * Returns max number parameter from request.
     *
     * @param int|null $default The default value if the parameter key does not exist
     * @return integer
     */
    public function limit(?int $default = null): int
    {
        return $this->getRequest()->get('max', $default ?? config('params.maxRowsOnPage'));
    }

    /**
     * Returns page parameter from request.
     *
     * @param mixed $default The default value if the parameter key does not exist
     * @return integer
     */
    public function page(int $default = 1): int
    {
        return $this->getRequest()->get('page', $default);
    }

    public abstract function getListParameters(): array;
}
