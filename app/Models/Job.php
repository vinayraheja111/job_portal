<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function jobType(){
        return $this->belongsTo(JobType::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
