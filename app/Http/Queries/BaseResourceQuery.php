<?php

namespace App\Http\Queries;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Base ResourceQuery class for standards resources
 */
class BaseResourceQuery
{
    protected Model $eloquent;
    /**
     * Default pagination param perPage
     */
    protected int $defaultPagination = 10;

    /**
     * Allowed fields for filtering
     */
    protected array $allowedFilters = [];

    /**
     * Allowed fields for Product sorting
     */
    protected array $allowedSorting = [];

    public function __construct(string $eloquentClass)
    {
        $this->eloquent = new $eloquentClass;
    }

    /**
     * Return QueryBuilder results
     */
    public function get(): LengthAwarePaginator
    {
        return QueryBuilder::for($this->eloquent::class)
            ->allowedFilters($this->getAllowedFilters())
            ->allowedSorts($this->getAllowedSorting())
            ->paginate(request("per_page", $this->getDefaultPagination()))
            ->appends(request()->query());
    }

    /**
     * Get allowed filters
     */
    private function getAllowedFilters(): array
    {
        return $this->allowedFilters;
    }

    /**
     * Get allowed fields for sorting
     */
    private function getAllowedSorting(): array
    {
        return $this->allowedSorting;
    }

    /**
     * Get default perPage pagination param
     */
    private function getDefaultPagination(): int
    {
        return $this->defaultPagination;
    }
}
