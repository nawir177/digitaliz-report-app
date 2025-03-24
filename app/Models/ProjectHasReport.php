<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
class ProjectHasReport extends Model
{
    protected $fillable =['uuid','report_id','project_id'];
    // uuid generator
    protected static function boot()
    {
    
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }  

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function report(){
        return $this->belongsTo(Report::class);
    }

    public function listReport(){
        return $this->hasMany(ListReport::class);
    }
}
