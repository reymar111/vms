<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionViolation extends Model
{

    protected $table = 'transaction_violations';

    public function student()
    {

        return $this->belongsTo(Student::class, 'student_id', 'id');

    }

    public function violation()
    {

        return $this->belongsTo(Violation::class, 'violation_id', 'id');

    }

    public function offense_level()
    {

        return $this->belongsTo(OffenseLevel::class, 'offense_level_id', 'id');

    }

    public function penalty_action()
    {

        return $this->belongsTo(PenaltyAction::class, 'penalty_action_id', 'id');

    }

    public function status()
    {

        return $this->belongsTo(Status::class, 'status_id', 'id');

    }
}
