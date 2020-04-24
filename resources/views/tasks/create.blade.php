@extends('layouts.layout')
@section('content')
    <div class="col-md-6">
        @include('errors.errors')
        <form action="{{route('store')}}" method="post" enctype="multipart/form-data">
            @csrf

            @include('tasks.form')

            <button type="submit" class="btn btn-primary">Create task</button>
        </form>
    </div>
@endsection