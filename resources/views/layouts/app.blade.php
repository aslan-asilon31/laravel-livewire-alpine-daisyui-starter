<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ isset($title) ? $title . ' - ' . config('app.name') : config('app.name') }}</title>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" />

  {{-- Flatpickr  --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


  <!-- Include Alpine.js dan Axios -->
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.sheetjs.com/xlsx-0.20.0/package/dist/xlsx.full.min.js"></script>

  <script type="module">
    import {
      z
    } from "https://cdn.jsdelivr.net/npm/zod@3.22.4/+esm";
    window.z = z;
  </script>




  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles
</head>

<body class="min-h-screen font-sans antialiased bg-base-200">
  <x-toast />
  {{-- NAVBAR mobile only --}}
  <x-nav sticky class="lg:hidden">
    <x-slot:brand>
      <x-app-brand />
    </x-slot:brand>
    <x-slot:actions>
      <label for="main-drawer" class="lg:hidden me-3">
        <x-icon name="o-bars-3" class="cursor-pointer" />
      </label>
    </x-slot:actions>
  </x-nav>

  {{-- MAIN --}}
  <x-main class="">
    {{-- SIDEBAR --}}
    <livewire:partials.sidebar />

    {{-- The `$slot` goes here --}}
    <x-slot:content>
      {{ $slot }}


    </x-slot:content>
  </x-main>

  {{--  TOAST area --}}
  <x-toast />

  @livewireScriptConfig

  @stack('scripts')
</body>

</html>
