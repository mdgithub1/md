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
     * @inheritdoc
     */
    public function index(): AnonymousResourceCollection
    {
        return  parent::index();
    }
}
