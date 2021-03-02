<?php
namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TodoController extends Controller
{
    /**
     * Returns the index of pending todos
     * @return \Inertia\Response
     */
    public function index()
    {
        $user = auth()->user();
        return Inertia::render('Todo/Index', [
            'todos' => Todo::forUser($user)->pending()->get(),
        ]);
    }

    /**
     * Marks a Todo as completed
     * @param TodoRequest $request
     * @param Todo $todo
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function done(TodoRequest $request, Todo $todo) {
        $todo->markAsCompleted();
        return redirect(route("todos.index"));
    }

    /**
     * Create a new Todo and store it in the DB
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {
        $form = $request->validate(['title' => "required|string"]);
        $form["user_id"] = auth()->id();
        Todo::create($form);

        return redirect(route("todos.index"));
    }
}
