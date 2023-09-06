<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Task;
use App\Models\Category;

class TaskController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list() {
        $tasks = Task::latest()->paginate(5);
        return view('tasks.list',compact('tasks'))->with('i', (request()->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add() {
        $categories = Category::get();
       // return view('categories.edit',compact('category'));

        return view('tasks.add',compact('categories'));
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) { 
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
  
        if($validator->fails()){
            $response = [
                'success' => false,
                'message' =>  $validator->errors()->first()
               
            ];
           
            return response()->json($response, 400);
        }
        $request = $request->all();
        $request['start_date'] = date("Y-m-d", strtotime($request['start_date']));
        $request['end_date'] = date("Y-m-d", strtotime($request['end_date']));
        //print_r($request); exit;
        Task::create($request);
   
        $response = [
            'success' => true,
            'message' => 'Task created successfully'
        ];

        return response()->json($response, 200);
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $task = Task::where('id', $id)->first();
        $categories = Category::get();
        return view('tasks.edit',compact('task', 'categories'));
    }   
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
  
        if($validator->fails()){
            $response = [
                'success' => false,
                'message' =>  $validator->errors()->first()
               
            ];
           
            return response()->json($response, 400);
        
        }

        $task_id = $request->task_id;
        $category_id = $request->category_id;
        $title = $request->title;
        $description = $request->description;
        $start_date = date("Y-m-d", strtotime($request->start_date));
        $end_date = date("Y-m-d", strtotime($request->end_date));

        //Category::create($request->all());
        Task::where("id", $task_id)->update(["category_id" => $category_id,"title" => $title,"description" => $description,"start_date" => $start_date,"end_date" => $end_date]);
   
        $response = [
            'success' => true,
            'message' => 'Task updated successfully'
        ];

        return response()->json($response, 200);
       
    }   
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request) { 
        
        $task_id = $request['task_id'];
        Task::where('id', $task_id)->delete();
  
        $response = [
            'success' => true,
            'message' => 'Task deleted successfully'
        ];

        return response()->json($response, 200);
    }       

}
