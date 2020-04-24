<div class="form-group">
    <label for="title">Task title:</label>
    <input type="text" class="form-control" name="title" value="{{old('title') ?? $task->title ?? ''}}">
</div>

<div class="form-group">
    <label for="body">Description:</label>
    <textarea class="form-control" name="body" cols="40" rows="4">{{old('body') ?? $task->body ?? ''}}</textarea>
</div>

<div class="form-group">
    <input type="file" class="form-control-file border" name="attachment">
</div>

@if(request()->is('*/edit'))
    <div class="form-group">
        <label for="body">Answer:</label>
        <textarea class="form-control" name="answer" cols="40" rows="4"></textarea>
    </div>
@endif