@extends('layouts.main')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<section class="w-full pt-28">
  <div class="container w-10/12 lg:w-1/2 mx-auto bg-gray-900 rounded-lg py-5">
    <h2 class="text-2xl font-bold text-center mb-8 text-white">Search For Tasks</h2>
    <form method="POST" action="{{ route('tasks.search') }}" id="search-form">
      @csrf 
        <div class="flex">
            <div class="relative z-0 mx-auto mb-6 group">
                <input type="date" name="from" id="floating_from" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required value="{{ old('from') }}" />
                <label for="floating_from" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">From</label>
            </div>
            <div class="relative z-0 mx-auto mb-6 group">
                <input type="date" name="to" id="floating_to" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required value="{{ old('to') }}" />
                <label for="floating_to" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">To</label>
            </div>
        </div>
      <div class="text-center">
        <button id="submit-button" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
      </div>
    </form>
  </div>
</section>

@if (session()->has('tasks'))
<h1 class='text-center font-bold text-md lg:text-2xl mt-16'>Tasks Between {{ old('from') }} and {{ old('to') }}</h1>
  @forelse (session()->get('tasks') as $task)
      <x-tasks.card :task="$task" />
  @empty
    <h1 class='text-center font-bold text-xl mt-16'>No task found</h1>
  @endforelse
@endif


@endsection