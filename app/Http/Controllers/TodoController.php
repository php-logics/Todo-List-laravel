<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $todo = Todo::query();
        if($req->search){
            $todo->where('title', 'LIKE', '%'.$req->search.'%')->orWhere('description', 'LIKE', '%'.$req->search.'%');
        }
        if($req->date){
            $todo->where('date','<', $req->date);
        }
        if($req->status){
            $todo->where('status', $req->status);
        }
        $todo_list = $todo->paginate(10);
        return view('todo.index',['todo_list'=>$todo_list]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required|string|max:30',
            'task_date' => 'required|date',
            'task_status' => 'required|string',
            'task_detail' => 'required|string'
        ]);
        if(!in_array($request->task_status,['pending','completed','cancel'])){
            return redirect()->back()->withErrors('Incorrect value from status');
        }
        Todo::create([
            'title' => $request->task_name,
            'description' => $request->task_detail,
            'status' => $request->task_status,
            'date' => $request->task_date,
        ]);
        return redirect()->route('todo.index')->with('success','Item Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $todo = Todo::find($id);
        if(!$todo){
            echo "Not Found";
        }
        return view('todo.edit',['todo'=>$todo]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $todo = Todo::find($id);
        if(!$todo){
            echo "Not Found";
        }

        $todo->title = $request->task_name;
        $todo->description = $request->task_detail;
        $todo->status = $request->task_status;
        $todo->date = $request->task_date;
        $todo->save();
        return redirect()->back()->with('success','Todo Item updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todo = Todo::find($id);
        if($todo){
            $todo->delete();
        }
        return redirect()->back()->with('success','Todo Item Deleted Successfully');
    }
}
