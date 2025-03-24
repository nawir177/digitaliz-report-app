<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
class ListReport extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable =['project_has_report_id','content'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function projectHasReport(){
        return $this->belongsTo(ProjectHasReport::class);  
    }

    public function image(){
        return $this->getFirstMediaUrl('images');
    }

    public function getOrder(){
        return $this->getMedia('images')[0]->id;
    }
}
