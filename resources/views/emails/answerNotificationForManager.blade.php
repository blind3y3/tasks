@component('mail::message')
# For Manager

Task "{{$task->title}}" was answered with message:<br>
"{{$task->answer}}"

Thanks,<br>
{{ config('app.name') }}
@endcomponent
