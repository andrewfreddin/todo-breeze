<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(['email' => 'a@b.com'])->create();

        //****************
        // Pending Todos
        //****************

        $chores = [
            "Wash Dishes",
            "Do Laundry",
            "Sweep Floors",
            "Clean Bathroom"
        ];

        foreach($chores as $chore) {
            Todo::factory(['title' => $chore])->create();
        }

        //****************
        // Completed Todos
        //****************
        $time = Carbon::yesterday();
        for($i = 5; $i > 0;$i--) {
            Todo::factory(['title' => $chore])->count(rand(1,10))->completed($time)->create();
            $time->subDay();
        }
    }
}
