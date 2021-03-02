<?php

namespace Tests\Feature;

use App\Models\Todo;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MarkAsCompletedTest extends TestCase
{
    use DatabaseMigrations;

    public function test_users_can_complete_their_todos()
    {
        $user = User::factory()->create();
        $todo = Todo::factory()->create();

        $response = $this->actingAs($user)->patch(route("todos.done", [1]));

        $this->assertNotNull(Todo::find($todo->id)->completed_at);
        $response->assertRedirect(route("todos.index"));
    }

    public function test_users_cant_complete_todos_belonging_to_others()
    {
        $users = User::factory()->count(2)->create();
        $todo = Todo::factory()->create();

        $response = $this->actingAs($users[1])->patch(route("todos.done", [1]));

        $this->assertEquals($response->status(), 403);
        $this->assertNull(Todo::find($todo->id)->completed_at);
    }
}
