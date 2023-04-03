@extends('layouts.main')

@section('content')
<section class="w-full mt-20">
    <div class="container mx-auto text-center items-center">
        <h1 class="text-3xl font-bold text-center mt-20">Tasks For Today</h1>
        <button class="bg-blue-600 rounded-lg py-1 px-8 my-5" data-modal-target="create-task-modal" data-modal-toggle="create-task-modal">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-10 h-10 fill-white stroke-blue-600 mx-auto">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </button>

        <x-tasks.modals.create-task />

        @forelse ($tasks as $task)
            <x-tasks.card :task="$task" />
        @empty
            <h1>No Task Available</h1>
        @endforelse
        <div class="w-10/12 lg:w-1/3 mx-auto py-5">
            {{ $tasks->links() }}
        </div>
    </div>
</section>
@endsection