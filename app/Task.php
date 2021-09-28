<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 *
 * @OA\Schema(
 *     description="Task model",
 *     title="Task",
 *     @OA\Property(
 *         format="int64",
 *         title="ID",
 *         property="id",
 *     ),
 *     @OA\Property(
 *         format="string",
 *         title="Title",
 *         property="title",
 *     ),
 *     @OA\Property(
 *         format="string",
 *         title="body",
 *         property="body",
 *     ),
 * )
 *
 */
class Task extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function attachments()
    {
        return $this->hasMany('App\Attachment');
    }
}
