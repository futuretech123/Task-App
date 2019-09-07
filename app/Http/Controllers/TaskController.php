<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Task;
use Auth;

class TaskController extends Controller
{
    
    public function index()
    {
        // paginate the authorized user's tasks with 5 per page
        $tasks = Auth::user()
            ->tasks()
            ->orderBy('is_complete')
            ->orderByDesc('created_at')
            ->paginate(5);

        // return task index view with paginated tasks
        return view('tasks', [
            'tasks' => $tasks
        ]);
    }

    
    public function store(Request $request)
    {
        // validate the given request
        $data = $this->validate($request, [
            'title' => 'required|string|max:255',
        ]);

        // create a new incomplete task with the given title
        // $this->User->createTask($data['title']);
        Auth::user()->tasks()->create([
            'title' => $data['title'],
            'is_complete' => false,
        ]);

        // flash a success message to the session
        session()->flash('status', 'Task Created!');

        // redirect to tasks index
        return redirect('/tasks');
    }

    
    public function update(Task $task)
    {
        // check if the authenticated user can complete the task
        $this->authorize('complete', $task);

        if ($task->is_complete) {
            $status = false;
            $msg = "Task is Reopen!";
        }else{
            $status = true;
            $msg = "Task Completed!";
        }

        // mark the task as complete and save it
        $task->is_complete = $status;
        $task->save();

        // flash a success message to the session
        session()->flash('status', $msg);

        // redirect to tasks index
        return redirect('/tasks');
    }
}
