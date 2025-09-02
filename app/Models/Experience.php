<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'applicant_id','institution','designation','from_date','to_date','total_period','subjects_taught',
        'current',
    ];
}
