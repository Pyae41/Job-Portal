<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'job_type_id',
        'location_id',
        'company_id',
        'job_position',
        'skill',
        'salary',
        'deadline',
        'description',
        'status',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function jobType(){
        return $this->belongsTo(JobType::class);
    }

    public function applicants(){
        return $this->hasMany(Application::class);
    }

    public function saveJob(){
        return $this->hasOne(SaveJob::class);
    }
}
