<?php

namespace App\Http\Controllers;

use App\Attachment;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $taskId
     * @return \Illuminate\Http\Response
     */
    public function index(int $taskId)
    {
        return response()->json(Attachment::where('task_id', $taskId)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $taskId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $taskId)
    {
        if (!$request->file('file')->isValid()) {
            return response()->json([
                'code' => 422,
                'message' => 'Unprocessable Entity',
            ], 422);
        }

        $path = $request->file('file')->store('public');

        $created = Attachment::create([
            'task_id' => $taskId,
            'url' => $path,
        ]);

        return response()->json($created, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function show(Attachment $attachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attachment $attachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attachment $attachment)
    {
        //
    }
}
