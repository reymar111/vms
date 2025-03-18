<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'programs';

    protected $with = ['college'];

    protected $fillable = [
        'code', 'description'
    ];

    public function college()
    {

        return $this->belongsTo(College::class, 'college_id', 'id');

    }
}
