<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $table = 'academic_years';

    public function semester()
    {

        return $this->belongsTo(Semester::class, 'semester_id', 'id');

    }
}
