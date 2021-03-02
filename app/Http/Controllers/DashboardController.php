<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $start = Carbon::tomorrow()->subDays(7);
        $end = Carbon::tomorrow();

        $list = Todo::completed()
            ->whereBetween("completed_at", [$start, $end])
            ->get()
            ->groupBy(function($item, $key) {
                return $item->completed_at->toDateString();
            })
            ->map(function($item, $key) {
                return $item->count();
            })
            ->reverse()
            ->merge([$end->toDateString() => null]);

        return Inertia::render('Dashboard', [
            "labels" => $list->keys(),
            "values" => $list->values()->filter(),
        ]);
    }
}
