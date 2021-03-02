<?php
namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TodoController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return Inertia::render('Todo/Index', [
            'todos' => Todo::forUser($user)->pending()->get(),
        ]);
    }

    public function done(TodoRequest $request, Todo $todo) {
        $todo->markAsCompleted();
        return redirect(route("todos.index"));
    }

    public function store(Request $request) {
        $form = $request->validate([
            'title' => "required|string"
        ]);

        $form["user_id"] = auth()->id();
        Todo::create($form);

        return redirect(route("todos.index"));
    }
}
