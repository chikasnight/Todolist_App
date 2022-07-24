<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompletedTask;
use App\Http\Resources\CompletedTaskResource;

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
            'data' =>new CompletedTaskResource($newTask),
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
                'completedTask'=>new CompletedTaskResource($task)
                
            ]
        ]);
    }
    public function search(Request $request){
        $task =new CompletedTask();
        $query =$task-> newQuery();

        if($request->has('header')){
            $query= $query->where('header', $request->header);
        
        }

        if($request->has('task')){
            $query= $query->where('task', $request->task);
        }
        

        
        return response()->json([
            'success'=> true,
            'message'=>'search results found',
            'data'=> $query->get()

            
        ]);
        
    }
}
