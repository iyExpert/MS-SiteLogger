<?php

namespace App\Models;

use App\Repositories\QueryFilters\BaseCriteriaBuilder;
use App\Repositories\QueryFilters\ICriteria;
use App\Repositories\QueryFilters\ICriteriaBuilder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorContract;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait DefaultScoped for base scoped functions with use Query Builder.
 * @package App\Models
 *
 * @method Builder|self orderByParams($column, $value)
 * @method Builder|self filterWhere($value, \Closure $condition)
 * @method static Builder|self alias($alias)
 * @method static Builder|self fromCriteriaBuilder(ICriteriaBuilder $criteriaBuilder)
 * @method static Builder|self fromCriteria(ICriteria...$list)
 */
trait DefaultScoped
{
    protected ?string $alias = null;

    /**
     * Get name column with global alias of query.
     *
     * @param string $column the field in table in database.
     * @return string returns column with alias. For example 'alias.column'
     */
    public function withAlias(string $column): string
    {
        $tbName = $this->getTable();
        return $this->alias ? $this->alias.'.'.$column : $tbName.'.'.$column;
    }

    /**
     * Initializes this query builder by criteria builder.
     *
     * @param self|Builder $query the eloquent builder.
     * @param ICriteriaBuilder $criteriaBuilder the builder of list criteria.
     * @return DefaultScoped|Builder|\Illuminate\Database\Query\Builder returns build query builder by criteria.
     * @see CriteriaBuilder
     */
    public function scopeFromCriteriaBuilder($query, ICriteriaBuilder $criteriaBuilder): self|Builder|\Illuminate\Database\Query\Builder
    {
        return $criteriaBuilder->compose($query);
    }

    /**
     * Apply single criteria to this query builder.
     *
     * @param self|Builder $query the eloquent builder.
     * @param ICriteria[] $list
     * @return DefaultScoped|Builder|\Illuminate\Database\Query\Builder
     */
    public function scopeFromCriteria($query, ICriteria...$list)
    {
        foreach ($list as $criteria) {
            $criteria->apply($query);
        }

        return $query;
    }

    /**
     * Add "order by" to query by column and method sort: asc or desc.
     *
     * @param Builder $query
     * @param string $column
     * @param string $value
     *
     * @return Builder
     */
    public function scopeOrderByParams(Builder $query, string $column, string $value): Builder
    {
        return $query->orderBy($this->withAlias($column), $value);
    }

    /**
     * Set alias to from.
     *
     * @param Builder $query
     * @param string $alias
     * @return Builder
     */
    public function scopeAlias(Builder $query, string $alias): Builder
    {
        $this->alias = $alias;
        $table = $query->getModel()->getTable();
        return $query->from($table.' as '.$alias);
    }

    /**
     * Scope for eloquent builder for get name column with global alias of query.
     *
     * @param Builder|self $query the eloquent builder.
     * @param string $column the field in table in database.
     * @return string returns column with alias. For example 'alias.column'
     */
    public function scopeWithAlias(self|Builder $query, string $column): string
    {
        return $this->withAlias($column);
    }
}
