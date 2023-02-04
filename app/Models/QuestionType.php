<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuestionType extends Model
{
    /**
     * The attributes that aren't mass assignable.
     * @var array
     */
    protected $guarded = [];

    /**
     * Questions associated with type.
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'type_id', 'id');
    }
}
