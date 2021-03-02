<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'title' ];

    /**
     * Sets the todo item as completed in the database
     */
    public function markAsCompleted() {
        $this->completed_at = Carbon::now();
        $this->save();
    }

    /**********
     * Relationships
     ********/

    /**
     * Defines relationship with App\Models\User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class, "user_id");
    }

    /**
     * Returns only completed todos
     * @param $query
     * @param Carbon|null $date
     * @return mixed
     */
    public function scopeCompleted($query) {
        return $query->whereNotNull("completed_at");
    }

    /**
     * Returns only pending todos
     * @param $query
     * @param Carbon|null $date
     * @return mixed
     */
    public function scopePending($query) {
        return $query->whereNull("completed_at");
    }

    /**
     * Scopes query to specific user
     * @param $query
     * @param User $user
     * @return mixed
     */
    public function scopeForUser($query, User $user) {
        return $query->where("user_id", "=", $user->id);
    }
}
