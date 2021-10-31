<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExpensesTest extends TestCase
{
    /**
     * Base URL
     */
    protected string $baseUrl;

    /**
     * Product item structure JSON
     */
    protected array $jsonResponseStructure;

    /**
     * Paginated list structure JSON
     */
    private array $jsonStructurePagination;

    /**
     * Error structure JSON
     */
    protected array $jsonError;

    public function setUp(): void
    {
        $this->baseUrl = env('APP_URL') . '/api/expenses/';

        // Correct response JSON
        $this->jsonResponseStructure =
            [
                "data" => [
                    "*" => [
                        "expense_id",
                        "expense_value",
                        "expense_description",
                        "expense_type" => [
                            "id",
                            "description",
                        ],
                    ],
                ]
            ];

        // Error response JSON
        $this->jsonError =
            [
                "errors" =>
                    [
                        "*" =>
                            [
                                "status",
                                "title",
                                "detail",
                                "source" =>
                                    [
                                        "pointer",
                                        "method",
                                    ],

                            ],
                    ],
            ];

        parent::setUp();
    }

    /**
     * Test paginated list structure in response
     */
    public function testIndex(): void
    {
        $response = $this->get($this->baseUrl);

        $response
            ->assertSuccessful()
            ->assertJsonStructure($this->jsonResponseStructure);
    }

    /**
     * Test paginated list with applied filters in response
     */
    public function testIndexWithProductTypeFilters(array $filters = ['expenses_type_id' => 4]): void
    {
        foreach ($filters as $filter => $val) {
            $response = $this->get($this->baseUrl . "?filter[$filter]=$val");

            $response
                ->assertSuccessful()
                ->assertJsonFragment(
                    [
                        "id" => $val,
                    ]
                );
        }
    }

    /**
     * Test paginated list with invalid filters
     */
    public function testIndexWithInvalidFilters(array $filters = ['invalid_filter' => 1]): void
    {
        foreach ($filters as $filter => $val) {
            $response = $this->get($this->baseUrl . "?filter[$filter]=$val");

            $response
                ->assertStatus(400)
                ->assertJsonStructure($this->jsonError);
        }
    }

    /**
     * Test exact returned pages in response
     */
    public function testIndexPaginatedItemsPerPage(int $perPage = 2): void
    {
        $response = $this->get(uri: $this->baseUrl . "?per_page=" . $perPage);

        $response
            ->assertSuccessful()
            ->assertJsonCount(count: $perPage, key: "data");
    }

    /**
     * Test exact returned pages in response with ordering
     */
    public function testIndexSortPaginatedItemsPerPage (int $perPage = 3, string $sort = '-value'): void
    {
        $response = $this->get(uri: $this->baseUrl . "?per_page=" . $perPage . "&sort=" . $sort);

        $response
            ->assertSuccessful()
            ->assertJsonCount(count: $perPage, key: "data");
    }

    /**
     * Test returned page when sort with wrong property name
     */
    public function testIndexSortPaginatedItemsWithWrongPropertyName (string $sort = 'lorem'): void
    {
        $response = $this->get(uri: $this->baseUrl . "?sort=" . $sort);

        $response
            ->assertStatus(status: 400)
            ->assertJsonStructure($this->jsonError);
    }
}
