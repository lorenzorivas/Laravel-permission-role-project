<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Auth;

class TaskController extends Controller
{
	public function index(Request $request)
	{
		$auth_id = Auth::id();

        $busqueda  = $request->get('busqueda');

        // $tasks = Task::orderBy('id', 'DESC')->where('user_id', '=', $auth_id)->where("is_complete", false)->busqueda($busqueda)->paginate(30);

        $tasks = Task::orderBy('is_complete', 'ASC')->where('user_id', '=', $auth_id)->busqueda($busqueda)->paginate(30);
        $total_task = Task::where('user_id', '=', $auth_id)->count();
        $tasks_complete = Task::where('user_id', '=', $auth_id)->where("is_complete", true)->count();
        $tasks_incomplete = Task::where('user_id', '=', $auth_id)->where("is_complete", false)->count();
        if ($total_task !== 0) {
        $percentage = ($tasks_complete / $total_task * 100);
        }

        if ($total_task == 0) {
        $percentage = 0;
        }
        return view("task.index", compact("tasks", 'tasks_complete', 'tasks_incomplete', 'total_task', 'percentage'));
	}

	public function store(Request $request)
    {
        $this->validate($request, [
        'title' => 'required|string|max:255',
        ],
            [ 
                'title.required' => 'Asigna un titulo!',
            ]);

    	Auth::user()->tasks()->create([
            'title' => $request['title'],
            'is_complete' => false,
        ]);

    	return back()->with('info', 'Tarea creada con exito');
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $newTask = $task->update(['is_complete' => true]);

        return back()->with('info', 'Tarea finalizada');
    }
}