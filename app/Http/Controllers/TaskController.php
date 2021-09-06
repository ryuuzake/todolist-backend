<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\CreateTaskRequest;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/tasks",
     *     tags={"tasks"},
     *     summary="Returns a List of Tasks",
     *     description="Returns a List of Task Resources",
     *     operationId="getTasks",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     * )
     */
    public function index()
    {
        return response()->json(Task::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *     path="/tasks",
     *     tags={"tasks"},
     *     summary="Create a Task",
     *     description="Create a single task",
     *     operationId="addTask",
     *     @OA\Response(
     *         response=201,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity"
     *     ),
     *     requestBody={"$ref": "#/components/requestBodies/CreateTask"}
     * )
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'user_id' => 'required|exists:App\User,id'
        ]);

        $created = Task::create($request->all());

        return response()->json($created, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *     path="/tasks/{taskId}",
     *     tags={"tasks"},
     *     summary="Find Task by ID",
     *     description="Return a single task",
     *     operationId="getTaskById",
     *     @OA\Parameter(
     *         name="taskId",
     *         in="path",
     *         description="Task id to return",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found"
     *     ),
     * )
     */
    public function show(Task $task)
    {
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     *
     * @OA\Patch(
     *     path="/tasks/{taskId}",
     *     tags={"tasks"},
     *     operationId="updateTask",
     *     @OA\Parameter(
     *         name="taskId",
     *         in="path",
     *         description="Task id to return",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found"
     *     ),
     * )
     */
    public function update(Request $request, Task $task)
    {
        $this->validate($request, [
            'user_id' => 'nullable|exists:App\User,id'
        ]);

        $updated = $task->update($request->all());

        return response()->json($updated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     *
     * @OA\Delete(
     *     path="/tasks/{taskId}",
     *     tags={"tasks"},
     *     summary="Deletes a task",
     *     operationId="deleteTask",
     *     @OA\Parameter(
     *         name="taskId",
     *         in="path",
     *         description="Task id to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         ),
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="successful delete task"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found",
     *     ),
     * )
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response('', 204);
    }
}
