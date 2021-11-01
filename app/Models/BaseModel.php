<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Base model to simplify repeatable entries in models
 */
class BaseModel extends Model
{
    use HasFactory;

    /**
     * @inheritdoc
     */
    protected $connection = 'mysql';

    /**
     * @inheritdoc
     */
    public $timestamps = false;
}
