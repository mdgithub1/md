<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expenses extends BaseModel
{
    /**
     * @inheritdoc
     */
    protected $table = 'expenses';

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'value',
        'description',
        'expenses_type_id',
    ];

    /**
     * @inheritdoc
     */
    protected $with = [
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
