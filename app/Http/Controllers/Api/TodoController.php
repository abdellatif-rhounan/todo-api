<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $data = Todo::all();

        if ($data->isNotEmpty()){
            return response($data, 200);
        }
        else {
            return response("No Todo Found", 200);
        }
    }

    public function store(Request $request)
    {
        $validData = $request->validate([
            'text' => 'required|string|max:150',
        ]);

        $todo = Todo::create([
            'text' => $validData['text'],
            'completed' => false,
        ]);

        if ($todo) {
            return response($todo, 201);
        }
        else {
            return response('Service Unavailable!', 503);
        }
    }

    public function update(Request $request, Todo $todo)
    {
        $validData = $request->validate([
            'text' => 'required|string|max:150',
            'completed' => 'required|boolean',
        ]);

        $result = $todo->update([
            'text' => $validData['text'],
            'completed' => $validData['completed'],
        ]);

        if ($result) {
            return response($todo, 200);
        } else {
            return response('Service Unavailable!', 503);
        }
    }

    public function destroy(Todo $todo)
    {
        $result = $todo->delete();

        if ($result) {
            return response('Todo Deleted', 200);
        } else {
            return response('Service Unavailable!', 503);
        }
    }

    public function check_all(Request $request)
    {
        $validData = $request->validate([
            'checked' => 'required|boolean',
        ]);

        $result = Todo::query()->update([
            'completed' => $validData['checked'],
        ]);

        if ($result) {
            return response('Todos Updated', 200);
        } else {
            return response('Service Unavailable!', 503);
        }
    }

    public function clear_completed(Request $request)
    {
        $validData = $request->validate([
            'ids' => 'required|array',
        ]);

        $result = Todo::destroy($validData['ids']);

        if ($result) {
            return response('Todos Deleted', 200);
        } else {
            return response('Service Unavailable!', 503);
        }
    }
}
