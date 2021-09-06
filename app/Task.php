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
    //
}
