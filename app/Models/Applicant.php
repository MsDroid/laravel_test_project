<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model 
{
    use Notifiable;

    protected $fillable = [
        'user_id','advt_no','already_applied','post','subject','bed_required',
        'gender','physically_handicapped','handicap_details','category','category_certificate_no','dob',
        'full_name','mobile','photo_id_type','photo_id_no','photo_id_image','current_step','address','submitted','submitted_at','status','registration_no'
    ];

    protected $dates = ['dob','submitted_at'];

    public function user(){ return $this->belongsTo(User::class); }
    public function payments(){ return $this->hasOne(Payment::class); }
    public function educations(){ return $this->hasMany(Education::class); }
    public function experiences(){ return $this->hasMany(Experience::class); }
    public function documents(){ return $this->hasMany(Document::class); }
    public function acknowledgement(){ return $this->hasOne(Acknowledgement::class); }
}
