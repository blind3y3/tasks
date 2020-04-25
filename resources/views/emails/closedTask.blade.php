@component('mail::message')
# Hello, {{$receiver->name}}

Your task "{{$task->title}}" was closed.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
