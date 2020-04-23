@extends('layouts.layout')
@section('content')
    @if(Auth::user()->isManager)
        {{--            <p>Информация для менеджера</p>--}}
    @endif
    @foreach($tasks as $task)
        <div class="col-md-6 border">
            <h3>{{$task->title}}</h3>
            <p>{{$task->body}}</p>
        </div>
    @endforeach
@endsection