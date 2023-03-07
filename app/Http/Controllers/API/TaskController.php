<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Mail\NewTaskNotifier;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class TaskController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tasks = Task::where('user_id', auth('api')->user()->id)->orderBy('created_at', 'desc')->get();
        if (count($tasks) > 0) {
            if ($request->get('completed') != null && ($request->get('completed') == 'true' || $request->get('completed') == 'false')) {
                $tasks = $this->completedTasks($tasks, $request->get('completed'));
            }
        }
        if (count($tasks) > 0) {
            if ($request->get('overdue') != null && ($request->get('overdue') == 'true' || $request->get('overdue') == 'false')) {
                $tasks = $this->overDueTask($tasks, $request->get('overdue'));
            }
        }

        return $this->successResponse($tasks, 'Tasks suceessfully recieved');
    }

    public function completedTasks($tasks, $status)
    {
        $today =  date('Y-m-d');
        if ($status == 'true') {
            $tasks = $tasks->where('due_date', '>=', $today);
        } else {
            $tasks = $tasks->where('due_date', '<=', $today);
        }
        return $tasks;
    }

    public function overDueTask($tasks, $status)
    {
        if ($status == 'true') {
            $status = 1;
        } else {
            $status = 0;
        }
        $tasks = $tasks->where('completed', $status);
        return $tasks;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        DB::beginTransaction();

        try {
            $request['user_id'] = auth('api')->user()->id;
            $task = $this->StoreTask($request);

            $user = User::find(auth('api')->user()->id);
            Mail::to($user->email)->send(new NewTaskNotifier($user->name));

            return $this->successResponse($task, 'Task suceessfully added');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function StoreTask($request)
    {
        $task = Task::create($request->all());
        return $task;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, $id)
    {
    }

    public function updatetask(UpdateTaskRequest $request, $id)
    {

        $task = Task::find($id);
        if ($task != null) {
            $task->update($request->all());
            return $this->successResponse($task, 'Task suceessfully updated');
        } else {
            return $this->errorResponse('Task not found', 404);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        if ($task != null) {
            $task->delete();
            return $this->successResponse($task, 'Task suceessfully deleted');
        } else {
            return $this->errorResponse('Task not found', 404);
        }
    }
}
