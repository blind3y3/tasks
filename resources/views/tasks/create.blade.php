@extends('layouts.layout')
@section('content')

    <div class="col-md-6">
        <form action="{{route('store')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Task title:</label>
                <input type="text" class="form-control" name="title" value="{{old('title') ?? ''}}">
            </div>

            <div class="form-group">
                <label for="body">Description:</label>
                <textarea class="form-control" name="body" cols="40" rows="4">{{old('body') ?? ''}}</textarea>
            </div>

            <div class="form-group">
                <input type="file" class="form-control-file border" name="img">
            </div>

            <button type="submit" class="btn btn-primary">Create task</button>
        </form>
    </div>
@endsection