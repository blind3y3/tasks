@extends('layouts.layout')
@section('content')

    <form action="{{ route('update', ['id' => $task->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        @include('tasks.form')
        @include('tasks.checkboxes')
        <div class="btn-group mt-2">
        <a class="btn btn-primary" href="{{URL::previous()}}">Back</a>
        <button type="submit" class="btn btn-primary">Update task</button>
        </div>
    </form>

@endsection