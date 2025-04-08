<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <script src="//unpkg.com/alpinejs" defer></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.js"></script>

    @section('css')
    @show
    <style>
        .content-style: {
            background-color: red;
            width: 100%;
            height: 100%;

        }
    </style>

    <title> @yield('title')</title>
</head>

<body class="dark">


    <x-sidebar />
    <x-header />



    <div class=" sm:ml-64">
        <div style="" class="  border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            @section('content')

            @show
        </div>
    </div>

</body>

@section('js')
@show


</html>
