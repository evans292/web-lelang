<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#000000" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('font-awesome/app.css') }}" />

    {{ $style ?? ''}} 
    <style>
      input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
      }
  </style>
  <script src="{{asset('js/app.js')}}" defer></script>
     <!-- Init the plugin -->
     {{ $script ?? ''}} 
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
  </head>
  <body class="text-gray-800 antialiased">
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root">
      
        @include('layouts.operator.sidebar')

      <div class="relative md:ml-64 bg-gray-50">
        @include('layouts.operator.topbar')
        
        <!-- Content -->
        <div class="relative bg-gradient-to-r from-red-400 to-blue-500  md:pt-32 pb-32 pt-12">
          {{ $slot }}
        </div>
      </div>

    </div>

    
  </body>
</html>
