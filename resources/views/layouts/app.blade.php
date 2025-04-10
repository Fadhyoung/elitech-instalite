{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'My App')</title>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
