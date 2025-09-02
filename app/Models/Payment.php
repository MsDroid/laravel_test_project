<?php 


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id', 
        'bank_name',  // link with applicant
        'amount',
        'payment_ref',
        'payment_date',
        'receipt_path',
        
    ];

    // Relationship: Payment belongs to Applicant
    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
