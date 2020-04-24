<div>
    <input {{request()->is('*/edit') ? '' : 'disabled'}} {{$task->isOpened  ? 'checked' : ''}}  type="checkbox" name="isOpened" value="{{$task->isOpened}}"> Task is opened<br>
    <input {{request()->is('*/edit') ? '' : 'disabled'}} {{$task->isWatched ? 'checked' : ''}}  type="checkbox" name="isWatched" value="{{$task->isWatched}}"> Task is watched<br>
    <input {{request()->is('*/edit') ? '' : 'disabled'}} {{$task->isAnswered ? 'checked' : ''}} type="checkbox" name="isAnswered"  value="{{$task->isAnswered}}"> Task is answered<br>
</div>