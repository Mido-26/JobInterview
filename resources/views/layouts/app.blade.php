<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Database</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <style>
            body {
                font-family: 'figtree', sans-serif;
            }
        </style>  
</head>
<body class="bg-gray-100">
    <nav class="bg-gray-800 text-white">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="{{ route('applicants.index') }}" class="text-xl font-bold">CV Database</a>
                <div class="space-x-4">
                    <a href="{{ route('applicants.index') }}" class="hover:text-gray-300">All Applicants</a>
                                   
                    <a href="{{ route('applicants.create') }}" class="hover:text-gray-300">Add Applicant</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 py-6">
        @yield('content')
    </main>
</body>
</html>