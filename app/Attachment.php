<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'task_id' => 'integer',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url', 'task_id'
    ];

    public function task()
    {
        return $this->belongsTo('App\Task');
    }

    public function getUrlAttribute($value)
    {
        return env('APP_URL') . Storage::url($value);
    }
}
