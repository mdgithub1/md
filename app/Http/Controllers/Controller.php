<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller as BaseController;

/**
 * Controller class to return responses with standard resources
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected string $resourceClass;
    protected string $queryClass;
    protected string $eloquentClass;

    /**
     * Base for items listing
     */
    public function index(): AnonymousResourceCollection
    {
        $resource = new $this->resourceClass(request());
        $query = new $this->queryClass($this->eloquentClass);

        return  $resource::collection($query->get());
    }
}
