<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = ['personal_info_id','position','company','start_date','end_date'];
    public function user(){
        return $this->belongsTo(PersonalInfo::class);
    }
}
