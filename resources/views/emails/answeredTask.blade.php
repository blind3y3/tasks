@component('mail::message')
# Hello, {{$receiver->name}}

Your task "{{$task->title}}" was answered with message:<br>
"{{$task->answer}}"

@component('mail::button', ['url' => '/tasks'])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
