<!DOCTYPE html>
<html>
    <head>
        <title>{{ __('messages.Admin control') }}</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            body,
            html {
                height: 100%;
            }
    
            .container {
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                align-items: center,
            }
    
            .table-container {
                width: 100%;
            }
    
            .header-container {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100%;
                padding: 20px 0;
            }
    
            .dropdown-hover .dropdown-menu {
                display: none;
            }
    
            .dropdown-hover:hover .dropdown-menu {
                display: block;
            }
        </style>
<body>

    @include('includes.navbar')

    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>
    @yield('scripts')
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
