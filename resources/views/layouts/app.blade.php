<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Escreva'))</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('icons/logo-secundaria.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Loading Screen Styles -->
    <style>
        /* Loading Screen */
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
        }

        .loading-screen.fade-out {
            opacity: 0;
            visibility: hidden;
        }

        .loading-logo {
            width: 120px;
            height: 120px;
            margin-bottom: 20px;
            animation: pulse 2s infinite;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 20px;
        }

        .loading-text {
            color: white;
            font-family: 'Montserrat', sans-serif;
            font-size: 18px;
            font-weight: 500;
            text-align: center;
            margin-bottom: 10px;
        }

        .loading-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            text-align: center;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Hide main content while loading */
        .main-content {
            opacity: 0;
            transition: opacity 0.5s ease-in;
        }

        .main-content.loaded {
            opacity: 1;
        }

        /* Custom CSS for navigation font and color */
        nav, nav * {
            font-family: 'Montserrat', sans-serif !important;
            color: white !important;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Page specific styles -->
    @yield('styles')
    @stack('styles')
</head>
<body class="font-sans antialiased bg-white">
    <!-- Loading Screen -->
    <div id="loadingScreen" class="loading-screen">
        <img src="{{ asset('images/logo.png') }}" alt="Escreva Logo" class="loading-logo">
        <div class="loading-spinner"></div>
        <div class="loading-text">Carregando...</div>
        <div class="loading-subtitle">Preparando sua experiência</div>
    </div>

    <div class="min-h-screen bg-white main-content" id="mainContent">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @hasSection('header')
            <header class="bg-white">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>

    <!-- Loading Screen Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loadingScreen = document.getElementById('loadingScreen');
            const mainContent = document.getElementById('mainContent');
            
            // Simulate loading time (minimum 1.5 seconds for better UX)
            setTimeout(function() {
                // Hide loading screen
                loadingScreen.classList.add('fade-out');
                
                // Show main content
                mainContent.classList.add('loaded');
                
                // Remove loading screen from DOM after animation
                setTimeout(function() {
                    loadingScreen.remove();
                }, 500);
            }, 1500);
        });

        // Hide loading screen if page takes too long to load
        window.addEventListener('load', function() {
            const loadingScreen = document.getElementById('loadingScreen');
            const mainContent = document.getElementById('mainContent');
            
            if (loadingScreen && !loadingScreen.classList.contains('fade-out')) {
                loadingScreen.classList.add('fade-out');
                mainContent.classList.add('loaded');
                
                setTimeout(function() {
                    if (loadingScreen.parentNode) {
                        loadingScreen.remove();
                    }
                }, 500);
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
