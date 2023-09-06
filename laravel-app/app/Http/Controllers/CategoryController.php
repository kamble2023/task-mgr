<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list() {
        $categories = Category::latest()->paginate(5);
        return view('categories.list',compact('categories'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
  
        if($validator->fails()){
            $response = [
                'success' => false,
                'message' =>  $validator->errors()->first()
               
            ];
           
            return response()->json($response, 400);
        }

        Category::create($request->all());
   
        $response = [
            'success' => true,
            'message' => 'Category created successfully'
        ];

        return response()->json($response, 200);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request) { 
        
        $category_id = $request['cat_id'];
        Category::where('id', $category_id)->delete();
  
        $response = [
            'success' => true,
            'message' => 'Category deleted successfully'
        ];

        return response()->json($response, 200);
    }    


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $category = Category::where('id', $id)->first();
        return view('categories.edit',compact('category'));
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
            'name' => 'required'
        ]);
  
        if($validator->fails()){
            $response = [
                'success' => false,
                'message' =>  $validator->errors()->first()
               
            ];
           
            return response()->json($response, 400);
        
        }

        $category_id = $request->category_id;
        $category_name = $request->name;

        //Category::create($request->all());
        Category::where("id", $category_id)->update(["name" => $category_name]);
   
        $response = [
            'success' => true,
            'message' => 'Category updated successfully'
        ];

        return response()->json($response, 200);
       
    }    
}
