<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    use HasFactory;

    protected $fillable = ['job_type'];

    public function jobPosts(){
        return $this->hasMany(JobPost::class);
    }
}
