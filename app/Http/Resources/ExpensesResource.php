<?php

namespace App\Http\Resources;

use App\Models\ExpensesType;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * @property string       $description
 * @property double       $value
 * @property int          $id
 * @property ExpensesType $expenseType
 */
class ExpensesResource extends JsonResource
{
    /**
     * @inheritdoc
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'expense_id' => $this->id,
            'expense_value' => $this->value,
            'expense_description' => $this->description,
            'expense_type' => $this->expenseType,
        ];
    }
}
