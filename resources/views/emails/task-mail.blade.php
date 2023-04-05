<x-mail::message>
# Dear {{ $name }},

Below are yout tasks for today

@foreach($tasks as $task)
<x-mail::panel>
    <h1>{{ $task->title }}</h1>
    {{ $task->description }};
</x-mail::panel>
@endforeach

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
