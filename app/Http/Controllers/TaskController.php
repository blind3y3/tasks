<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Mail\AnsweredTaskMail;
use App\Task;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Storage;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Mail\ClosedTaskMail;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TaskRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(TaskRequest $request)
    {

        $task = new Task();
        $task->title = $request->title;
        $task->body = $request->body;
        $task->author = Auth::user()->name;
        $task->author_id = Auth::user()->id;

        if ($request->file('attachment')) {
            $path = Storage::putFile('public', $request->file('attachment'));
            $url = Storage::url($path);
            $task->attachment = $url;
        }

        $task->save();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function show($id)
    {

        $task = Task::findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TaskRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(TaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->title = $request->title;
        $task->body = $request->body;

        $receiver = User::findOrFail($task->author_id);

        $task->isOpened = $request->has('isOpened');
        $task->isWatched = $request->has('isWatched');
        $task->isAnswered = $request->has('isAnswered');

        if ($request->file('attachment')) {
            $path = Storage::putFile('public', $request->file('attachment'));
            $url = Storage::url($path);
            $task->attachment = $url;
        }

        if ($request->has('answer')){
            $task->answer = $request->answer;
            if ($request->answer != old($task->answer)){
                Mail::to($receiver->email)->send(new AnsweredTaskMail($receiver, $task));
            }
        }

        $task->update();

        return redirect()->route('show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        $receiver = User::findOrFail($task->author_id);
        Mail::to($receiver->email)->send(new ClosedTaskMail($receiver, $task));

        return redirect('/');
    }
}