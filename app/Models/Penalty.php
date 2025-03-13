<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    protected $table = 'penalties';

    public function violation()
    {

        return $this->belongsTo(Violation::class, 'violation_id', 'id');

    }

    public function action()
    {

        return $this->belongsTo(PenaltyAction::class, 'action_id', 'id');

    }
}
