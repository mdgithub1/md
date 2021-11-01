<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class ExpensesType extends BaseModel
{
    /**
     * @inheritdoc
     */
    protected $table = 'expenses_type';

   /*
   |----------------------------------------------------------------------
   | Relationships
   |----------------------------------------------------------------------
   */

    /**
     * Get expenses associated with expenses type
     */
    public function expenses(): hasMany
    {
        return $this->hasMany(Expenses::class, 'expenses_type_id', 'id');
    }
}
