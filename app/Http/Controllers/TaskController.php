<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\User;
use App\ClientTask;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:rm')->only('create', 'store');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['active_class'] = 'tasks';

        return view('tasks.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Task::create($request->all());
        
        return redirect()->back()->with('message', 'Task Created');;
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function assignClient(User $client)
    {
        $data['active_class'] = 'clients';
        $data['client'] = $client;
        $data['tasks'] = Task::all();

        $client_task_array = array();
        $client_tasks = ClientTask::where('client_id', $client->id)->get();
        foreach($client_tasks as $index => $client_task){
            $client_task_array[$index] = $client_task->task_id;
        }

        $data['client_task_array'] = $client_task_array;

        return view('tasks.assign', $data);
    }

    public function storeClientTasks(Request $request, $client_id)
    {
        $rows = $request->task_array;

        ClientTask::where('client_id', $client_id)->delete();

        foreach ($rows as $row) {
            ClientTask::insert([
                'client_id' => $client_id,
                'task_id' => $row
            ]);
        }

        return redirect()->back()->with('message', 'Task Assigned!');
    }
}