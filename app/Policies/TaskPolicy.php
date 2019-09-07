<?php

namespace App\Policies;

use App\User;
use App\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if a user can complete a task.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Task $task
     * @return bool
     */
    public function complete(User $user, Task $task)
    {
        return $user->is($task->user);
    }
}
