<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acknowledgement extends Model
{
    protected $fillable = [
        'applicant_id','ack_no','pdf_path'
    ];
}
