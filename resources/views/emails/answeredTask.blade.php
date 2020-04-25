@component('mail::message')
# Hello, {{$receiver->name}}

Your task "{{$task->title}}" was answered with message:<br>
"{{$task->answer}}"

Thanks,<br>
{{ config('app.name') }}
@endcomponent
