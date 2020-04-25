@extends('layouts.layout')
@section('content')
    @if(Auth::user()->isManager)
        <div class="col-md-12 mb-2">
            <div class="dropdown">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    Sort order:
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="?sortBy=isOpened">By opened</a>
                    <a class="dropdown-item" href="?sortBy=isWatched">By watched</a>
                    <a class="dropdown-item" href="?sortBy=isAnswered">By answered</a>
                </div>
            </div>
        </div>
    @endif
    @foreach($tasks as $task)
        @if(Auth::user()->isManager || Auth::user()->name == $task->author)
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
                    <a class="btn btn-primary" href="{{ route('show', ['id' => $task->id]) }}">Show task</a>
                    <a class="btn btn-primary" href="{{ route('edit', ['id' => $task->id]) }}">Update task</a>
                    @if($task->attachment)
                        <a class="btn btn-outline-primary" href="{{$task->attachment}}" download>Attachment</a>
                    @endif
                </div>
            </div>
        @endif
    @endforeach

@endsection