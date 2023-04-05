<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('app.name') }}</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <style>
input:-webkit-autofill {
    -webkit-background-clip: text;
    -webkit-text-fill-color: white;
}
  </style>
</head>
<body class="bg-gray-200">

<x-alert />

<nav class="bg-gray-900 dark:bg-gray-900 fixed w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
  <a href="{{ auth()->check() ? route('tasks.index') : route('auth.login-page') }}" class="flex items-center">
      <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 mr-3" alt="Flowbite Logo">
      <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">{{ config('app.name') }}</span>
  </a>
  <div class="flex md:order-2">
      @auth
        <button form="logout" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Logout</button>
      @endauth
      <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
      </button>
  </div>
  <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
    <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg  md:flex-row md:space-x-8 md:mt-0 md:border-0 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
      @auth
        <li>
          <a href="{{ route('tasks.index') }}" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-white md:p-0 md:dark:text-white" aria-current="page">Home</a>
        </li>
        <li>
          <a href="{{ route('tasks.search-page') }}" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-white md:p-0 md:dark:text-white" aria-current="page">Search</a>
        </li>
      @endauth
    </ul>
  </div>
  </div>
</nav>

@yield('content')

<div class="head"></div>

<footer class="fixed bottom-0 left-0 z-20 w-full p-4 bg-gray-900 border-t border-gray-200 shadow text-center md:p-6 dark:bg-gray-900 dark:border-gray-600">
  <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">
    © 2023 <a href="#" class="hover:underline">{{ config('app.name') }}</a>. All Rights Reserved.
  </span>
</footer>

<form action="{{ route('auth.logout') }}" method="post" id="logout">
  @csrf
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>

<script>
  // @see https://docs.headwayapp.co/widget for more configuration options.
  var HW_config = {
    selector: ".head", // CSS selector where to inject the badge
    account:  "7qQgW7"
  }
</script>
<script async src="https://cdn.headwayapp.co/widget.js"></script>
</body>
</html>
