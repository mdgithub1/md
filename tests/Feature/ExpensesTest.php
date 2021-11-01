<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ExpensesTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Base URL
     */
    protected string $baseUrl;

    /**
     * JSON Pattern
     */
    protected array $jsonItemPattern;

    /**
     * Single item structure JSON
     */
    protected array $jsonItem;

    /**
     * Item list structure JSON
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

        // Pattern JSON
        $this->jsonItemPattern = [
            "expense_id",
            "expense_value",
            "expense_description",
            "expense_type" => [
                "id",
                "description",
            ],
        ];

        // Correct response single item JSON
        $this->jsonItem = [
            "data" => $this->jsonItemPattern,
        ];

        // Correct response items list JSON
        $this->jsonResponseStructure =
            [
                "data" => [
                    "*" => $this->jsonItemPattern,
                    ],
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
    public function testIndexWithProductTypeFilters(array $filters = ['expenses_type_id' => 1]): void
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
        $response = $this->get( $this->baseUrl . "?per_page=" . $perPage);

        $response
            ->assertSuccessful()
            ->assertJsonCount($perPage, "data");
    }

    /**
     * Test exact returned pages in response with ordering
     */
    public function testIndexSortPaginatedItemsPerPage (int $perPage = 3, string $sort = '-value'): void
    {
        $response = $this->get( $this->baseUrl . "?per_page=" . $perPage . "&sort=" . $sort);

        $response
            ->assertSuccessful()
            ->assertJsonCount($perPage, "data");
    }

    /**
     * Test returned page when sort with wrong property name
     */
    public function testIndexSortPaginatedItemsWithWrongPropertyName (string $sort = 'lorem'): void
    {
        $response = $this->get($this->baseUrl . "?sort=" . $sort);

        $response
            ->assertStatus(422)
            ->assertJsonStructure($this->jsonError);
    }

    /**
     * Test single item response
     */
    public function testShow(int $identifier = 3): void
    {
        $response = $this->get($this->baseUrl . $identifier);

        $response
            ->assertSuccessful()
            ->assertJsonStructure($this->jsonItem);

    }

    /**
     * Test the error response if the row does not exist
     */
    public function testShowNonExistedItem(int $identifier = 99999999999999): void
    {
        $response = $this->get($this->baseUrl . $identifier);

        $response
            ->assertStatus(400)
            ->assertJsonStructure($this->jsonError);
    }

    /**
     * Update with correct data
     */
    public function testUpdateRequestWithCorrectData(
        int $identifier = 2,
        float $value = 111.22,
        string $description = "Lorem Ipsum",
        int $type = 1
    ):void
    {

        $data = [
            'value' => $value,
            'description' => $description,
            'expenses_type_id' => $type,
        ];

        $response = $this->json('PUT', $this->baseUrl . $identifier, $data);

        $response
            ->assertSuccessful()
            ->assertJsonStructure($this->jsonItem);
    }

    /**
     * Update with incorrect data (failed validation)
     */
    public function testUpdateRequestWithIncorrectData(
        int $identifier = 2,
        string $value = "wrong_type",
        string $description = "Lorem Ipsum",
        int $type = 1
    ): void
    {
        $data = [
            'value' => $value,
            'description' => $description,
            'expenses_type_id' => $type,
        ];

        $response = $this->json('PUT', $this->baseUrl . $identifier, $data);

        $response
            ->assertStatus(422)
            ->assertJsonStructure($this->jsonError);
    }

    /**
     * Create expense with correct data
     */
    public function testCreateRequestWithCorrectData(
        float $value = 88.99,
        string $description = "Lorem Ipsum",
        int $type = 5
    ):void
    {

        $data = [
            'value' => $value,
            'description' => $description,
            'expenses_type_id' => $type,
        ];

        $response = $this->json('POST', $this->baseUrl, $data);

        $response
            ->assertSuccessful()
            ->assertJsonStructure($this->jsonItem);
    }

    /**
     * Create expense with incorrect data (failed validation)
     */
    public function testCreateRequestWithIncorrectData(
        string $value = "wrong_type",
        string $description = "Lorem Ipsum",
        int $type = 1
    ): void
    {
        $data = [
            'value' => $value,
            'description' => $description,
            'expenses_type_id' => $type,
        ];

        $response = $this->json('POST', $this->baseUrl, $data);

        $response
            ->assertStatus(422)
            ->assertJsonStructure($this->jsonError);
    }

    /**
     * Delete expense using valid id
     */
    public function testDeleteRequestWithCorrectId(int $identifier = 2): void
    {
        $response = $this->json('DELETE', $this->baseUrl . $identifier);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                "message" => "Expense deleted successfully"
            ]);
    }

    /**
     * Delete expense using invalid id
     */
    public function testDeleteRequestWithIncorrectId(int $identifier = 99999999): void
    {
        $response = $this->json('DELETE', $this->baseUrl . $identifier);

        $response->assertStatus(404);
    }
}
