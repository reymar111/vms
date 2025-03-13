<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    protected $table = 'violations';

    public function category()
    {

        return $this->belongsTo(ViolationCategory::class, 'violation_category_id', 'id');

    }

    public function penalty()
    {

        return $this->belongsTo(Penalty::class, 'penalty_id', 'id');

    }
}
