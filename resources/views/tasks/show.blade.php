@extends('layouts.layout')
@section('content')
    <div class="col-md-6 border p-2">
        <h3>{{$task->title}}</h3>
        <p><i>Created by: {{$task->author}}</i></p>
        <p>{{$task->body}}</p>
        @include('tasks.checkboxes')

        @if($task->answer)
        <h4>Answer on your task:</h4>
        <div class="answer">
            <p>{{$task->answer}}</p>
        </div>
        @endif

        <div class="btn-group mt-2">
            <a class="btn btn-primary" href="{{URL::previous()}}">Back</a>
            <a class="btn btn-primary" href="{{ route('edit', ['id' => $task->id]) }}">Update task</a>
            @if($task->attachment)
                <a class="btn btn-outline-primary" href="{{$task->attachment}}" download>Attachment</a>
            @endif
        </div>
        <form action="{{route('destroy', ['id' => $task->id])}}" method="post">
            @csrf
            @method('delete')
            <input type="submit" class="btn btn-danger mt-2" value="Close task">
        </form>
    </div>
@endsection