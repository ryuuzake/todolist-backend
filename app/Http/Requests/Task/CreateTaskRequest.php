<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     *
     * @OA\RequestBody(
     *     request="CreateTask",
     *     description="Task object that needs to be added to the database",
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/Task"),
     * )
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'body' => 'required',
            'user_id' => 'required|exists:App\User,id'
        ];
    }
}
