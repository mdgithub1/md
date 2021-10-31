<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expenses extends BaseModel
{
    /**
     * @inheritdoc
     */
    protected string $table = 'expenses';

    /**
     * @inheritdoc
     */
    protected array $with = [
        'expenseType',
    ];

   /*
   |----------------------------------------------------------------------
   | Relationships
   |----------------------------------------------------------------------
   */

    /**
     * Get expense type associated with the image from ImageType
     */
    public function expenseType(): belongsTo
    {
        return $this->belongsTo(ExpensesType::class, 'expenses_type_id', 'id');
    }
}
