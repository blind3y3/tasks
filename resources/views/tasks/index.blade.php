@extends('layouts.layout')
@section('content')
    @if(Auth::user()->isManager)
        {{--            <p>Информация для менеджера</p>--}}
    @endif
    @foreach($tasks as $task)
        <div class="col-md-6 border p-2">
            <h3>{{$task->title}}</h3>
            <p>Created by: {{$task->author}}</p>
            <p>{{$task->body}}</p>
            @include('tasks.checkboxes')
            <div class="btn-group mt-2">
                <a class="btn btn-primary" href="{{ route('show', ['id' => $task->id]) }}">Show task</a>
                <a class="btn btn-primary" href="{{ route('edit', ['id' => $task->id]) }}">Update task</a>
                @if(!empty($task->attachment))
                    <a class="btn btn-outline-primary" href="{{$task->attachment}}" download>Attachment</a>
                @endif
            </div>

        </div>
    @endforeach
@endsection