<?php

namespace App\Models;

use App\Models\Program;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $appends = ['full_name'];

    public function program()
    {

        return $this->belongsTo(Program::class, 'program_id', 'id');

    }

    public function year_level()
    {

        return $this->belongsTo(YearLevel::class, 'year_level_id', 'id');

    }

    public function section()
    {

        return $this->belongsTo(Section::class, 'section_id', 'id');

    }

    public function getFullNameAttribute()
    {

        return $this->attributes['first_name'].' '.$this->attributes['last_name'].' '.$this->attributes['ext_name'];

    }
}
