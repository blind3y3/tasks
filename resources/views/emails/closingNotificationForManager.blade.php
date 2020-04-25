@component('mail::message')
# For Manager

Task "{{$task->title}}" was closed.

Thanks,<br>
{{ config('app.name') }}
@endcomponent