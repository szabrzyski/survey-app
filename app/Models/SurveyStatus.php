<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SurveyStatus extends Model
{
    /**
     * The attributes that aren't mass assignable.
     * @var array
     */
    protected $guarded = [];

    /**
     * Surveys associated with status.
     */
    public function surveys(): HasMany
    {
        return $this->hasMany(Survey::class, 'status_id', 'id');
    }
}
