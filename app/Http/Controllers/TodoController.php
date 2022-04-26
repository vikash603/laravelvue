<?php

namespace App\Http\Controllers;

use App\Todo;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(){
        return response()->json(Todo::get());
    }

    public function store(Request $request){
        $todo=Todo::create($request->all());
        return response()->json($todo);
    }

public function show(){
     return response()->json(Todo::get());

}

    public function destroy( Todo $todo){
        $todo->delete();
        return response ()->json('deleted');
    }
}
