<?php

namespace App\Http\Controllers;

use App\Http\Queries\ExpensesQuery;
use App\Http\Resources\ExpensesResource;
use App\Models\Expenses;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ExpensesController extends Controller
{
    protected string $resourceClass = ExpensesResource::class;
    protected string $queryClass = ExpensesQuery::class;
    protected string $eloquentClass = Expenses::class;

    /**
     * GET Paginated list
     *
     * <br><b>Available fields for sorting:</b>
     *      - <code>id</code>
     *      - <code>expenses_type_id</code>
     *      - <code>value</code>
     *
     * <br><b>Available fields for filtering:</b>
     *      - <code>expenses_type_id</code>
     *
     * @group Expenses
     *
     * @queryParam per_page int Page size: how many items per page. Example: 2
     * @queryParam page int Page number. Example: 1
     * @queryParam sort string Sorting parameter [value, -value]. Example: value
     * @queryParam filter[expenses_type_id] string Filters by e.g. product_name <code>filter[expanses_type_id]=4</code>. Example: 4
     *
     * @response status=400 scenario="Wrong parameter for filter" {"errors": [{"status": 400, "title": "Bad Request", "detail": "Requested filter(s) `expenses_type_id3` are not allowed. Allowed filter(s) are `expenses_type_id`.","source": { "pointer": "/api/expenses/", "method": "GET"}}]}
     */
    public function index(): AnonymousResourceCollection
    {
        return  parent::index();
    }

    /**
     * GET Single item.
     *
     * @group Expenses
     *
     * @response status=400 scenario="Wrong parameter for filter" {"errors": [{"status": 400, "title": "Bad Request", "detail": "Attempt to read property \"id\" on null.","source": { "pointer": "/api/expenses/", "method": "GET"}}]}
     */
    public function show(Expenses $expenses, int $id) : ExpensesResource
    {
        return new ExpensesResource($expenses::find($id));
    }
}
