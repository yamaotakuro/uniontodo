<?php

namespace App\Http\Controllers;
use App\Todo;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $todo = $user->load('todos');
        return $todo;
    }

    public function store(Request $request)
    {
        $todo = new Todo;
        $todo->id = $request->id;
        $todo->user_id = $request->user_id;
        $todo->title = $request->title;
        $todo->workload = $request->workload;
        $todo->body = $request->body;
        $todo->created_at = Carbon::now();
        $todo->updated_at = Carbon::now();
        $todo->save();
        // $todos = Todo::all();
        return $todo;
    }
    public function show(string $id)
    {
        // return $todo
    }
    public function update(Request $request, Todo $todo)
    {
      $todo->id = $request->id;
      $todo->user_id = $request->user_id;
      $todo->title = $request->title;
      $todo->workload = $request->workload;
      $todo->body = $request->body;
      $todo->created_at = Carbon::now();
      $todo->updated_at = Carbon::now();
      $todo->save();
      return $todo;
    }
    public function destroy(Request $request,Todo $todo)
    {
        $todo->delete();
        $user = $request->user();
        $todo = $user->load('todos');
        return $todo;
    }
}
