<?php

namespace App\Http\Queries;

use Spatie\QueryBuilder\AllowedFilter;

class ExpensesQuery extends BaseResourceQuery
{
    public function __construct(string $eloquentClass)
    {
        /**
         * Fields allowed for filtering
         */
        $this->allowedFilters = [
            AllowedFilter::exact("expenses_type_id"),
        ];

        /**
         * Fields allowed for sorting
         */
        $this->allowedSorting = [
            "id",
            "expenses_type_id",
            "value",
        ];

        parent::__construct($eloquentClass);
    }
}
