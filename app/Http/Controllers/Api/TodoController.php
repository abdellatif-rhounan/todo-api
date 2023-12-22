<?php

namespace App\Http\Controllers\Api;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        $data = Todo::get();

        return response($data, 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'text' => 'required|string|max:150',
            'completed' => 'boolean',
        ]);

        $todo = Todo::create($data);

        return response($todo, 201);
    }

    public function update(Request $request, Todo $todo)
    {
        $data = $request->validate([
            'text' => 'required|string|max:150',
            'completed' => 'boolean',
        ]);

        $todo->update($data);

        return response($todo, 200);
    }

    public function destroy(string $id)
    {
        Todo::destroy($id);

        return response('Todo Deleted Successfully', 200);
    }
}
