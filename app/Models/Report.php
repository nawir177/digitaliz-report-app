<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
class Report extends Model
{
    protected $fillable = ['uuid', 'user_id', 'start_date', 'end_date','status','note'];

    // uuid generator
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function projectHasReport(){
        return $this->hasMany(ProjectHasReport::class);
    }

    public function statusColor(){
        if($this->status == 'pending'){
            return 'bg-amber-400';
        }elseif($this->status == 'approved'){
            return 'bg-green-400';
        }else{
            return 'bg-red-600';
        }
    }
}
