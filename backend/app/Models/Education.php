<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = ['personal_info_id','degree_name','start_date','end_date'];
    public function personalInfo(){
        return $this->belongsTo(PersonalInfo::class);
    }
}
