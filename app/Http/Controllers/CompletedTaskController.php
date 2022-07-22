<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompletedTask;

class CompletedTaskController extends Controller
{

    public function deleteTask( $completedtaskId){

        $task = CompletedTask::find($completedtaskId);
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
    public function completedTask(Request $request){
        //validate request body
        $request->validate([
            'header'=>['required'],
            'task'=>['required'],
            
        ]);
        //create a blog post
        $newTask = CompletedTask::create([
            'user_id'=>3,
            'header'=> $request->header,
            'task'=> $request->task,
           
            
        ]);
        
        //return cuccess response

        return response()->json([
            'success'=> true,
            'message'=>'successfully completed a Task',
            'data' =>$newTask,
        ]);
    }
    public function getCompletedTask(Request $request, $completedtaskId){
        $task = CompletedTask::find($completedtaskId);
        if(!$task) {
            return response() ->json([
                'success' => false,
                'message' => 'Task not found'
            ]);
        }

        return response() ->json([
            'success'=> true,
            'message'  => 'task found',
            'data'   => [
                'property'=>$task
                
            ]
        ]);
    }
}
