<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use Notifiable;

    protected $table = 'educations';

    protected $fillable = [
        'applicant_id','level','board_university','subjects','year_of_passing','marks_obtained','marks_total',
        'division','certificate_no'
    ];

    
}
