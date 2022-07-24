<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todolist;
use App\Http\Resources\TodolistResource;



class TodolistController extends Controller
{
    public function newTask(Request $request){
        //validate request body
        $request->validate([
            'header'=>['required'],
            'task'=>['required'],
            
        ]);
        //create a blog post
        $newTask = Todolist::create([
            'user_id'=>auth()->id(),
            'header'=> $request->header,
            'task'=> $request->task,
           
            
        ]);
        
        //return cuccess response

        return response()->json([
            'success'=> true,
            'message'=>'successfully created a Task',
            'data' =>new TodolistResource($newTask),
        ]);
    }
    
    public function updateTask(Request $request, $todolistId){
        $request->validate([
            'header'=>['required'],
            'task'=>['required'],

        ]);
        
        $updateTask = Todolist::find($todolistId);
        if(!$todolistId) {
            return response() ->json([
                'success' => false,
                'message' => 'Task not found'
            ]);

        $this->authorize('update',$updateTask);

        }

        $updateTask->header = $request->header;
        $updateTask->task = $request->task;
        $updateTask->save();
        return response() ->json([
            'success' => true,
            'message' => 'Task updated',
            'data'  => new TodolistResource($updateTask)
        ]);
    }
    public function deleteTask( $todolistId){

        $task = Todolist::find($todolistId);
        if(!$task) {
            return response() ->json([
                'success' => false,
                'message' => 'Task not found'
            ]);
        }

        

        //$this->authorize('delete',$task);
        //delete property
        $task-> delete();

        return response() ->json([
            'success' => true,
            'message' => 'task deleted'
            ]); 
    }
}
