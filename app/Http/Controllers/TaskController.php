<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $tasks= Task::all();
        return response()->json([
            'status' => 'success',
            'tasks' => $tasks,
        ], 200); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(TaskRequest $request)
    {
        


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request):JsonResponse{
        DB::beginTransaction();
        try {
            // Create a new task record
           
        $task = Task::query()->create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'priority'=> $request->get('priority'),
            'due_date'=> $request->get('due_date'),
            'status'=>$request->get('status')


  
        ]);
        DB::commit();
        return response()->json([
            'message' => 'task created',
            'data' => [
                'task' => $task,
            ]
        ], 200);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage()
              
            ], 500);
        }
        
                       
       
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
      
            try {
                $task = Task::findOrFail($id);
                return response()->json($task);
            } catch (\Exception $e) {
                return response()->json(['error' => 'task not found'], 404);
            }
        }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   
    public function update(TaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);

        $task->update($request->all());

        return response()->json($task);
    }
     /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(['message' => 'task deleted successfully']);
    }
   
   
}
