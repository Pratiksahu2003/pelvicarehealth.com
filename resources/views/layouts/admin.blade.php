<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Pelvicare</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .heading-font {
            font-family: 'Poppins', sans-serif;
        }
        /* Global heading scale – uniform, professional, responsive */
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            line-height: 1.3;
            color: inherit;
        }
        h1 { font-size: 1.5rem !important; }
        h2 { font-size: 1.375rem !important; }
        h3 { font-size: 1.25rem !important; }
        h4 { font-size: 1.125rem !important; }
        h5 { font-size: 1rem !important; }
        h6 { font-size: 0.9375rem !important; }
        @media (min-width: 640px) {
            h1 { font-size: 1.75rem !important; }
            h2 { font-size: 1.5rem !important; }
            h3 { font-size: 1.375rem !important; }
            h4 { font-size: 1.25rem !important; }
            h5 { font-size: 1.125rem !important; }
            h6 { font-size: 1rem !important; }
        }
        @media (min-width: 1024px) {
            h1 { font-size: 2rem !important; }
            h2 { font-size: 1.625rem !important; }
            h3 { font-size: 1.5rem !important; }
            h4 { font-size: 1.25rem !important; }
            h5 { font-size: 1.125rem !important; }
            h6 { font-size: 1rem !important; }
        }
        /* Global paragraph and body text – reduced, professional */
        body {
            font-size: 0.9375rem;
            line-height: 1.6;
        }
        p, li, .prose p, .prose li { font-size: inherit; line-height: 1.6; }
        @media (min-width: 1024px) {
            body { font-size: 1rem; }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-white to-gray-50 shadow-lg flex flex-col">
            <div class="p-6 border-b">
                <div class="flex items-center justify-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('images/pelvicarehealth_logo.png') }}" 
                             alt="Pelvicare Health" 
                             class="h-12 w-auto object-contain max-w-full"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="hidden items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-pink-400 to-pink-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-lg">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <h1 class="text-xl font-bold heading-font text-gray-900">Pelvicare</h1>
                                <p class="text-xs text-gray-600">{{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <nav class="mt-4 px-2">
                @if(auth()->user()->isSuperAdmin())
                    <a href="{{ route('super-admin.dashboard') }}" class="flex items-center px-4 py-3 mb-1 rounded-lg {{ request()->routeIs('super-admin.dashboard') ? 'bg-pink-100 text-pink-700 shadow-sm' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('super-admin.users') }}" class="flex items-center px-4 py-3 mb-1 rounded-lg {{ request()->routeIs('super-admin.users') ? 'bg-pink-100 text-pink-700 shadow-sm' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        Manage Users
                    </a>
                    <a href="{{ route('super-admin.doctor-verification') }}" class="flex items-center px-4 py-3 mb-1 rounded-lg {{ request()->routeIs('super-admin.doctor-verification*') ? 'bg-pink-100 text-pink-700 shadow-sm' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Doctor Verification
                    </a>
                    <a href="{{ route('admin.content.index') }}" class="flex items-center px-4 py-3 mb-1 rounded-lg {{ request()->routeIs('admin.content.*') ? 'bg-pink-100 text-pink-700 shadow-sm' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        Content Management
                    </a>
                    <a href="{{ route('admin.service-categories.index') }}" class="flex items-center px-4 py-3 mb-1 rounded-lg {{ request()->routeIs('admin.service-categories.*') || request()->routeIs('admin.service-subcategories.*') ? 'bg-pink-100 text-pink-700 shadow-sm' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        Service Management
                    </a>
                    <a href="{{ route('admin.blog.index') }}" class="flex items-center px-4 py-3 mb-1 rounded-lg {{ request()->routeIs('admin.blog.*') ? 'bg-pink-100 text-pink-700 shadow-sm' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Blog Management
                    </a>
                @elseif(auth()->user()->isAdmin())
                    <a href="{{ route('doctor.dashboard') }}" class="flex items-center px-4 py-3 mb-1 rounded-lg {{ request()->routeIs('doctor.dashboard') ? 'bg-blue-100 text-blue-700 shadow-sm' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('doctor.appointments') }}" class="flex items-center px-4 py-3 mb-1 rounded-lg {{ request()->routeIs('doctor.appointments*') ? 'bg-blue-100 text-blue-700 shadow-sm' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Appointments
                    </a>
                    <a href="{{ route('doctor.availability') }}" class="flex items-center px-4 py-3 mb-1 rounded-lg {{ request()->routeIs('doctor.availability*') ? 'bg-blue-100 text-blue-700 shadow-sm' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Availability
                    </a>
                    <a href="{{ route('doctor.profile') }}" class="flex items-center px-4 py-3 mb-1 rounded-lg {{ request()->routeIs('doctor.profile*') ? 'bg-blue-100 text-blue-700 shadow-sm' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        My Profile
                    </a>
                @elseif(auth()->user()->isPatient())
                    <a href="{{ route('patient.dashboard') }}" class="flex items-center px-4 py-3 mb-1 rounded-lg {{ request()->routeIs('patient.dashboard') ? 'bg-pink-100 text-pink-700 shadow-sm' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('patient.appointments') }}" class="flex items-center px-4 py-3 mb-1 rounded-lg {{ request()->routeIs('patient.appointments*') && !request()->routeIs('patient.appointments.book') ? 'bg-pink-100 text-pink-700 shadow-sm' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        My Appointments
                    </a>
                    <a href="{{ route('patient.appointments.book') }}" class="flex items-center px-4 py-3 mb-1 rounded-lg {{ request()->routeIs('patient.appointments.book') ? 'bg-pink-100 text-pink-700 shadow-sm' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Book Appointment
                    </a>
                    <a href="{{ route('patient.profile') }}" class="flex items-center px-4 py-3 mb-1 rounded-lg {{ request()->routeIs('patient.profile*') ? 'bg-pink-100 text-pink-700 shadow-sm' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        My Profile
                    </a>
                    <a href="{{ route('patient.reports') }}" class="flex items-center px-4 py-3 mb-1 rounded-lg {{ request()->routeIs('patient.reports*') ? 'bg-pink-100 text-pink-700 shadow-sm' : 'text-gray-700 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        My Reports
                    </a>
                @endif
            </nav>
            <div class="mt-auto p-4 border-t bg-gray-50">
                <div class="flex items-center mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-pink-400 to-pink-600 rounded-full flex items-center justify-center mr-3">
                        <span class="text-white font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-gray-900 text-sm truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-600 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition text-sm font-medium">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm border-b sticky top-0 z-10">
                <div class="px-6 py-4 flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold heading-font text-gray-900">@yield('page-title', 'Dashboard')</h2>
                        <p class="text-sm text-gray-600 mt-1">@yield('page-subtitle', '')</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('home') }}" target="_blank" class="text-gray-600 hover:text-gray-900 text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
    @stack('scripts')
</body>
</html>

