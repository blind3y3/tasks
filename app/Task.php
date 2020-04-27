<?php

namespace App;

use App\Mail\AnsweredTaskMail;
use App\Mail\AnswerNotificationForManager;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\TaskRequest;
use Auth;
use Illuminate\Support\Facades\Mail;

class Task extends Model
{
    public static function saveTask(TaskRequest $request)
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
    }

    public static function updateTask(TaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->title = $request->title;
        $task->body = $request->body;

        $receiver = User::findOrFail($task->author_id);
        $manager = User::select('email')->where('isManager', 1)->get()->first();

        $task->isOpened = $request->has('isOpened');
        $task->isWatched = $request->has('isWatched');
        $task->isAnswered = $request->has('isAnswered');

        if ($request->file('attachment')) {
            $path = Storage::putFile('public', $request->file('attachment'));
            $url = Storage::url($path);
            $task->attachment = $url;
        }

        if ($request->has('answer')) {
            $task->answer = $request->answer;
            if ($request->answer != old($task->answer)) {
                Mail::to($receiver->email)->send(new AnsweredTaskMail($receiver, $task));
                Mail::to($manager->email)->send(new AnswerNotificationForManager($task));
            }
        }

        $task->update();
    }
}
