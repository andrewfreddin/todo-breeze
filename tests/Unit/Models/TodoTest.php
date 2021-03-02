<?php
namespace Tests\Unit\Models;

use App\Models\Todo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use DatabaseMigrations;

    protected function getItem(array $params = []) {
        return Todo::factory($params)->create();
    }

    public function test_can_create() {
        $this->assertIsClass(Todo::class, $this->getItem());
    }

    public function test_has_user_relationship() {
        $user = User::factory()->create();
        $item = $this->getItem();
        $this->assertIsClass(User::class, $item->user);
    }

    public function test_whereCompleted_scope_only_returns_completed_todo() {
        // two completed items
        $completed = Todo::factory()->completed()->count(2)->create();
        // one non completed item
        $pending = Todo::factory()->create();

        $this->assertEquals(2, Todo::completed()->count());
    }

    public function test_wherePending_scope_only_returns_completed_todo() {
        // two completed items
        $completed = Todo::factory()->completed()->count(2)->create();
        // one non completed item
        $pending = Todo::factory()->create();

        $this->assertEquals(1, Todo::pending()->count());
    }

    public function test_forUser_scope_only_returns_todo_for_that_user() {
        $users = User::factory()->count(2)->create();

        // user 1 has two non completed tasks
        $todo1 = Todo::factory(['user_id' => 1])->count(2)->create();

        // user 2 has five non completed tasks
        $todo2 = Todo::factory(['user_id' => 2])->count(5)->create();

        $this->assertEquals(2, Todo::forUser($users[0])->count());
        $this->assertEquals(5, Todo::forUser($users[1])->count());
    }

    public function test_forUser_scope_with_completed_scope() {
        $users = User::factory()->count(2)->create();

        // user 1 has two non completed tasks and one completed task
        $todo1 = Todo::factory(['user_id' => 1])->count(2)->create();
        $done1 = Todo::factory(['user_id' => 1])->completed()->create();

        // user 2 has five non completed tasks and three completed
        $todo2 = Todo::factory(['user_id' => 2])->count(5)->create();
        $done2 = Todo::factory(['user_id' => 2])->completed()->count(3)->create();

        $this->assertEquals(1, Todo::forUser($users[0])->completed()->count());
    }

    public function test_forUser_scope_with_pending_scope() {
        $users = User::factory()->count(2)->create();

        // user 1 has two non completed tasks and one completed task
        $todo1 = Todo::factory(['user_id' => 1])->count(2)->create();
        $done1 = Todo::factory(['user_id' => 1])->completed()->create();

        // user 2 has five non completed tasks and three completed
        $todo2 = Todo::factory(['user_id' => 2])->count(5)->create();
        $done2 = Todo::factory(['user_id' => 2])->completed()->count(3)->create();

        $this->assertEquals(5, Todo::forUser($users[1])->pending()->count());
    }

    public function test_markAsCompleted_sets_completed_at_to_the_current_time_if_no_arg_passed() {
        $todo = Todo::factory()->create();
        $this->assertNull($todo->completed_at);
        $todo->markAsCompleted();

        $time = Todo::first()->completed_at;
        $this->assertEquals(Carbon::now(), $time);
    }
}
