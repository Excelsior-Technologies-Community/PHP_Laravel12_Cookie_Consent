<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Laravel Cookie Consent')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        .cookie-banner {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.9);
            color: white;
            padding: 1rem;
            z-index: 1000;
            animation: slideUp 0.5s ease;
        }
        
        @keyframes slideUp {
            from { transform: translateY(100%); }
            to { transform: translateY(0); }
        }
        
        .cookie-banner a {
            color: #ffc107;
        }
        
        .cookie-preferences {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 10px;
            margin-top: 2rem;
        }
        
        .cookie-category {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            background: white;
        }
        
        .cookie-category.required {
            background: #e8f4f8;
        }
        
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }
        
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }
        
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        
        input:checked + .slider {
            background-color: #28a745;
        }
        
        input:checked + .slider:before {
            transform: translateX(26px);
        }
        
        input:disabled + .slider {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                Laravel Cookie Consent
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav ms-auto">

    <li class="nav-item">
        <a
            class="nav-link"
            href="{{ route('home') }}"
        >
            Home
        </a>
    </li>

    <li class="nav-item">
        <a
            class="nav-link"
            href="{{ route('dashboard') }}"
        >
            Dashboard
        </a>
    </li>

    <li class="nav-item">
        <a
            class="nav-link"
            href="{{ route('cookie.policy') }}"
        >
            Cookie Policy
        </a>
    </li>

    <li class="nav-item">
        <a
            class="nav-link"
            href="{{ route('cookie.history') }}"
        >
            Consent History
        </a>
    </li>

    <li class="nav-item">
        <a
            class="nav-link"
            href="#"
            data-bs-toggle="modal"
            data-bs-target="#cookiePreferences"
        >
            Cookie Settings
        </a>
    </li>

</ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    @if(!request()->cookie('cookie_consent'))
        @include('cookie.banner')
    @endif

    @include('cookie.preferences-modal', [
    'currentConsent' => json_decode(
        request()->cookie('cookie_consent'),
        true
    )
])

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Cookie consent handling
        document.addEventListener('DOMContentLoaded', function() {
            // Handle accept all button
            const acceptAllBtn = document.getElementById('acceptAllCookies');
            if (acceptAllBtn) {
                acceptAllBtn.addEventListener('click', function() {
                    document.querySelectorAll('.cookie-category input[type="checkbox"]').forEach(cb => {
                        if (!cb.disabled) {
                            cb.checked = true;
                        }
                    });
                    document.getElementById('saveCookiePreferences').click();
                });
            }
            
            // Handle reject all button
            const rejectAllBtn = document.getElementById('rejectAllCookies');
            if (rejectAllBtn) {
                rejectAllBtn.addEventListener('click', function() {
                    document.querySelectorAll('.cookie-category input[type="checkbox"]').forEach(cb => {
                        if (!cb.disabled) {
                            cb.checked = false;
                        }
                    });
                    document.getElementById('saveCookiePreferences').click();
                });
            }
        });
    </script>
    
    @yield('scripts')
</body>
</html>