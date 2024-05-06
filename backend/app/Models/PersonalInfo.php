<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'profile_pic',
        'name',
        'email',
        'nrc',
        'dob',
        'phone',
        'address',
        'city',
        'country',
        'skill',
        'marital_status',
        'gender',
        'profession'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function educations(){
        return $this->hasMany(Education::class);
    }

    public function experiences(){
        return $this->hasMany(Experience::class);
    }
}
