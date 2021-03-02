<?php
namespace App\Http\Controllers;

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

    public function done(Request $request, Todo $todo) {
        $request->validate([]);
        $todo->markAsCompleted();

        return redirect(route("todos.index"));
    }
}
