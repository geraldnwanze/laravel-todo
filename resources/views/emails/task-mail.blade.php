<x-mail::message>

# Dear {{ $name }},

Below are your tasks for the day


@forelse ($tasks as $task)
    <x-tasks.card :task="$task" />
@empty
    
@endforelse

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
