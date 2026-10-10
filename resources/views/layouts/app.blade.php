<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @hasSection('meta_description')
    <meta name="description" content="@yield('meta_description')">
    @else
    <meta name="description" content="Pain during sex? Leaking urine after childbirth? Connect with verified womens health physiotherapists in Delhi NCR. Private, safe, judgment-free care.">
    @endif
    
    @hasSection('title')
    <title>@yield('title')</title>
    @else
    <title>Womens Health Physiotherapy India | Pain During Sex & Postpartum Care</title>
    @endif
    @hasSection('meta_keywords')
    <meta name="keywords" content="@yield('meta_keywords')">
    @endif
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-K8TJPFHL');</script>
<!-- End Google Tag Manager -->
    @stack('meta')
    
    <!-- Schema Markup (JSON-LD) -->
    @php
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'MedicalWebPage',
            'name' => "Women's Health Physiotherapy Platform India",
            'specialty' => "Women's Health Physiotherapy",
            'areaServed' => [
                '@type' => 'Country',
                'name' => 'India'
            ],
            'availableLanguage' => ['en', 'hi'],
            'description' => "Pain during sex? Leaking urine after childbirth? Connect with verified women's health physiotherapists in Delhi NCR. Private, safe, judgment-free care."
        ];
    @endphp
    <script type="application/ld+json">
    {!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Favicon -->
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

<!-- PNG favicon (optional but recommended) -->
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon.webp') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.webp') }}">

<!-- Apple Touch Icon -->
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon.webp') }}">
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-L4N4P17NNW"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-L4N4P17NNW');
</script>

    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    
    <style>
        /* CSS Variables */
        :root {
            --pink-50: #FFE5EC;
            --pink-100: #FFC2D4;
            --pink-200: #FF9DBB;
            --pink-300: #FF85A2;
            --pink-400: #FF5C8D;
            --pink-500: #FF3D7F;
            --pink-600: #E6356F;
        }
        
        /* Base Styles */
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .heading-font {
            font-family: 'Poppins', sans-serif;
        }
        
        html {
            scroll-behavior: smooth;
        }
        
        /* Global heading scale – uniform, professional, responsive (overrides inline text-* classes) */
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            line-height: 1.3;
            color: inherit;
        }
        h1 { font-size: 3rem !important; }
        h2 { font-size: 1.9rem !important; }
        h3 { font-size: 1.5rem !important; }
        h4 { font-size: 1.25rem !important; }
        h5 { font-size: 1rem !important; }
        h6 { font-size: 0.9375rem !important; }
        p { font-size: 14px !important; }
        li { font-size: 13px !important; }
        .prose p { font-size: 14px !important; }
        .prose li { font-size: 13px !important; }
        /* Ensure rich-text editor lists render as real lists */
        .prose ul {
            list-style-type: disc !important;
            list-style-position: outside !important;
            margin: 0.75rem 0 0.75rem 1.25rem !important;
            padding-left: 1rem !important;
        }
        .prose ol {
            list-style-type: decimal !important;
            list-style-position: outside !important;
            margin: 0.75rem 0 0.75rem 1.25rem !important;
            padding-left: 1rem !important;
        }
        .prose li {
            display: list-item !important;
            margin: 0.25rem 0 !important;
        }

        /*
         * Editorial / CMS rich text — overrides global heading scale (!important) so
         * Quill/TinyMCE headings look like polished article typography, not page heroes.
         */
        .rich-content {
            --rich-text: #374151;
            --rich-heading: #111827;
            --rich-muted: #6b7280;
            --rich-border: #fce7f3;
            --rich-accent: #db2777;
            color: var(--rich-text);
            font-size: 1rem;
            line-height: 1.7;
        }
        .rich-content > *:first-child {
            margin-top: 0 !important;
        }
        .rich-content > *:last-child {
            margin-bottom: 0 !important;
        }
        .rich-content p {
            font-size: 1rem !important;
            line-height: 1.75 !important;
            color: var(--rich-text) !important;
            margin: 0 0 1.125rem !important;
        }
        .rich-content li {
            font-size: 0.9375rem !important;
            line-height: 1.65 !important;
            color: var(--rich-text) !important;
        }
        .rich-content strong,
        .rich-content b {
            color: var(--rich-heading) !important;
            font-weight: 600 !important;
        }
        .rich-content a {
            color: var(--rich-accent) !important;
            font-weight: 500;
            text-decoration: underline;
            text-underline-offset: 3px;
            transition: color 0.15s ease;
        }
        .rich-content a:hover {
            color: #be185d !important;
        }
        /* Headings: editorial scale (NOT page-hero sizes) */
        .rich-content h1,
        .rich-content h2,
        .rich-content h3,
        .rich-content h4,
        .rich-content h5,
        .rich-content h6 {
            font-family: 'Poppins', sans-serif !important;
            font-weight: 700 !important;
            color: var(--rich-heading) !important;
            letter-spacing: -0.025em !important;
            line-height: 1.28 !important;
        }
        .rich-content h1 {
            font-size: 1.5rem !important;
            margin: 0 0 0.875rem !important;
            padding-bottom: 0.5rem !important;
            border-bottom: 1px solid var(--rich-border) !important;
        }
        .rich-content h2 {
            font-size: 1.25rem !important;
            margin: 2rem 0 0.75rem !important;
            padding-bottom: 0.375rem !important;
            border-bottom: 1px solid #f3f4f6 !important;
        }
        .rich-content h1 + h2,
        .rich-content h2:first-child {
            margin-top: 0 !important;
        }
        .rich-content h3 {
            font-size: 1.125rem !important;
            font-weight: 600 !important;
            margin: 1.5rem 0 0.5rem !important;
            color: #1f2937 !important;
        }
        .rich-content h4 {
            font-size: 1.0625rem !important;
            font-weight: 600 !important;
            margin: 1.25rem 0 0.5rem !important;
            color: #374151 !important;
        }
        .rich-content h5,
        .rich-content h6 {
            font-size: 1rem !important;
            font-weight: 600 !important;
            margin: 1rem 0 0.375rem !important;
            color: #4b5563 !important;
        }
        .rich-content ul,
        .rich-content ol {
            margin: 0.75rem 0 1.25rem !important;
            padding-left: 1.35rem !important;
        }
        .rich-content ul {
            list-style-type: disc !important;
        }
        .rich-content ol {
            list-style-type: decimal !important;
        }
        .rich-content li {
            margin: 0.35rem 0 !important;
            padding-left: 0.25rem !important;
        }
        .rich-content li::marker {
            color: #f472b6 !important;
        }
        .rich-content blockquote {
            margin: 1.25rem 0 !important;
            padding: 1rem 1.25rem !important;
            border-left: 4px solid #f9a8d4 !important;
            border-radius: 0 0.75rem 0.75rem 0 !important;
            background: linear-gradient(90deg, rgba(253, 242, 248, 0.9) 0%, rgba(255, 255, 255, 0.5) 100%) !important;
            color: #4b5563 !important;
            font-style: normal !important;
        }
        .rich-content blockquote p {
            margin-bottom: 0.5rem !important;
        }
        .rich-content blockquote p:last-child {
            margin-bottom: 0 !important;
        }
        .rich-content hr {
            margin: 2rem 0 !important;
            border: 0 !important;
            height: 1px !important;
            background: linear-gradient(90deg, transparent, #e5e7eb, transparent) !important;
        }
        .rich-content img {
            border-radius: 0.75rem !important;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.06) !important;
            margin: 1.25rem 0 !important;
            max-width: 100% !important;
            height: auto !important;
        }
        .rich-content table {
            width: 100% !important;
            font-size: 0.875rem !important;
            border-collapse: collapse !important;
            margin: 1.25rem 0 !important;
            border-radius: 0.5rem !important;
            overflow: hidden !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06) !important;
        }
        .rich-content th,
        .rich-content td {
            border: 1px solid #e5e7eb !important;
            padding: 0.625rem 0.875rem !important;
            text-align: left !important;
        }
        .rich-content th {
            background: #fdf2f8 !important;
            font-weight: 600 !important;
            color: var(--rich-heading) !important;
        }
        @media (min-width: 640px) {
            .rich-content h1 {
                font-size: 1.75rem !important;
            }
            .rich-content h2 {
                font-size: 1.375rem !important;
            }
            .rich-content h3 {
                font-size: 1.1875rem !important;
            }
        }

        article p { font-size: 13px !important; }
        article li { font-size: 13px !important; }
        /* Blog/article body: keep editorial rich text readable (overrides article p/li above) */
        article .rich-content p {
            font-size: 1rem !important;
        }
        article .rich-content li {
            font-size: 0.9375rem !important;
        }
        @media (min-width: 640px) {
            h1 { font-size: 2.5rem !important; }
            h2 { font-size: 1.5rem !important; }
            h3 { font-size: 1.375rem !important; }
            h4 { font-size: 1.25rem !important; }
            h5 { font-size: 1.125rem !important; }
            h6 { font-size: 1rem !important; }
        }
        @media (min-width: 1024px) {
            h1 { font-size: 3rem !important; }
            h2 { font-size: 1.5rem !important; }
            h3 { font-size: 1.2rem !important; }
            h4 { font-size: 1.25rem !important; }
            h5 { font-size: 1rem !important; }
            h6 { font-size: 0.9375rem !important; }
        }
        
        /* Global paragraph and body text – reduced, professional, responsive */
        body {
            font-size: 0.9375rem;
            line-height: 1.6;
        }
        p, li, .prose p, .prose li, article p, article li {
            font-size: inherit;
            line-height: 1.6;
        }
        @media (min-width: 640px) {
            body { font-size: 0.9375rem; }
        }
        @media (min-width: 1024px) {
            body { font-size: 1rem; }
        }
        
        /* Remove global transition that causes conflicts */
        button, a, input, select, textarea {
            transition: all 0.2s ease;
        }
        
        /* Theme: same as home page – page background and cards site-wide */
        .theme-page-bg {
            background: linear-gradient(to bottom right, var(--pink-50, #fdf2f8) 0%, #ffffff 50%, rgba(253, 242, 248, 0.6) 100%);
            min-height: 100%;
        }
        .theme-card {
            background: linear-gradient(to bottom right, #fdf2f8, #ffffff);
            border: 1px solid rgba(251, 207, 232, 0.8);
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transition: box-shadow 0.2s ease, transform 0.2s ease;
        }
        .theme-card:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .theme-card-solid {
            background: #ffffff;
            border: 1px solid rgba(251, 207, 232, 0.8);
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        /* Glassmorphism effect */
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        /* Navigation Styles */
        .nav-link {
            display: inline-block;
            padding: 0.5rem 0;
            white-space: nowrap;
        }
        
        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
        }
        
        /* Mobile menu */
        .mobile-menu {
            display: none;
        }
        
        .mobile-menu.active {
            display: block;
        }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased">
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K8TJPFHL"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center flex-shrink-0">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('images/pelvicarehealth_logo.png') }}" 
                             alt="Pelvicare Health - Women's Health Physiotherapy" 
                             class="h-12 md:h-16 w-auto object-contain"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="hidden items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-pink-400 to-pink-600 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="text-xl font-bold heading-font text-gray-900">Pelvicare<sup class="text-xs text-red-600">®</sup></div>
                                <div class="text-xs text-gray-600">Women's Health Physiotherapy</div>
                            </div>
                        </div>
                    </a>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-3 lg:space-x-4 xl:space-x-6">
                    <a href="{{ route('home') }}" class="nav-link text-gray-700 hover:text-pink-600 font-medium text-sm {{ request()->routeIs('home') ? 'text-pink-600' : '' }}">Home</a>
                    <a href="{{ route('doctors.index') }}" class="nav-link text-gray-700 hover:text-pink-600 font-medium text-sm {{ request()->routeIs('doctors.*') ? 'text-pink-600' : '' }}">Doctors</a>
                    <a href="{{ route('services') }}" class="nav-link text-gray-700 hover:text-pink-600 font-medium text-sm {{ request()->routeIs('services') ? 'text-pink-600' : '' }}">Services</a>
                    <a href="{{ route('treatments') }}" class="nav-link text-gray-700 hover:text-pink-600 font-medium text-sm {{ request()->routeIs('treatments') ? 'text-pink-600' : '' }}">Treatments</a>
                    <a href="{{ route('blog.index') }}" class="nav-link text-gray-700 hover:text-pink-600 font-medium text-sm {{ request()->routeIs('blog.*') ? 'text-pink-600' : '' }}">Blog</a>
                    <a href="{{ route('about') }}" class="nav-link text-gray-700 hover:text-pink-600 font-medium text-sm {{ request()->routeIs('about') ? 'text-pink-600' : '' }}">About</a>
                    <a href="{{ route('faq') }}" class="nav-link text-gray-700 hover:text-pink-600 font-medium text-sm {{ request()->routeIs('faq') ? 'text-pink-600' : '' }}">FAQ</a>
                    
                    @auth
                        <!-- Authenticated User Menu -->
                        <div class="relative group" id="user-menu-container">
                            <button id="user-menu-button" class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                                <div class="w-8 h-8 bg-gradient-to-br from-pink-400 to-pink-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span class="text-gray-700 font-medium text-sm hidden lg:block truncate max-w-[15rem]">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 text-gray-600" style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div id="user-menu-dropdown" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-200 py-2 z-50">
                                <div class="px-4 py-3 border-b border-gray-200">
                                    <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ Auth::user()->email }}</p>
                                    <span class="inline-block mt-2 px-2 py-1 text-xs font-semibold rounded-full 
                                        {{ Auth::user()->isSuperAdmin() ? 'bg-purple-100 text-purple-800' : '' }}
                                        {{ Auth::user()->isAdmin() ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ Auth::user()->isPatient() ? 'bg-pink-100 text-pink-800' : '' }}">
                                        {{ ucfirst(str_replace('_', ' ', Auth::user()->role)) }}
                                    </span>
                                </div>
                                
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 transition-colors">
                                    <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    Dashboard
                                </a>
                                
                                @if(Auth::user()->isPatient())
                                <a href="{{ route('patient.profile') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-pink-50 transition-colors">
                                    <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    My Profile
                                </a>
                                @endif
                                
                                <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-200 mt-2 pt-2">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- Guest User Menu -->
                        <a href="{{ route('book-appointment') }}" class="btn-primary bg-gradient-to-r from-pink-400 to-pink-500 text-white px-4 lg:px-5 py-2 lg:py-2.5 rounded-full hover:from-pink-500 hover:to-pink-600 shadow-md hover:shadow-lg font-semibold text-xs lg:text-sm">
                            <svg class="w-3.5 h-3.5 lg:w-4 lg:h-4 mr-1 lg:mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="hidden lg:inline">Book Appointment</span>
                            <span class="lg:hidden">Book</span>
                        </a>
                        
                        <a href="{{ route('login') }}" class="btn-primary bg-white text-pink-600 px-3 lg:px-5 py-2 lg:py-2.5 rounded-full hover:bg-pink-50 shadow-md hover:shadow-lg border-2 border-pink-300 font-semibold text-xs lg:text-sm">
                            Sign In
                        </a>
                        
                        <a href="{{ route('register-physiotherapist') }}" class="btn-primary bg-white text-pink-600 px-3 lg:px-5 py-2 lg:py-2.5 rounded-full hover:bg-pink-50 shadow-md hover:shadow-lg border-2 border-pink-300 font-semibold text-xs lg:text-sm">
                            <span class="hidden xl:inline">Join as Physiotherapist</span>
                            <span class="xl:hidden">Join Us</span>
                        </a>
                    @endauth
                </div>
                
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="md:hidden text-gray-700 hover:text-pink-600 p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu md:hidden bg-white border-t border-gray-200">
            <div class="px-4 pt-2 pb-4 space-y-2">
                <a href="{{ route('home') }}" class="block px-4 py-3 text-gray-700 hover:bg-pink-50 rounded-lg font-medium {{ request()->routeIs('home') ? 'bg-pink-50 text-pink-600' : '' }}">Home</a>
                <a href="{{ route('doctors.index') }}" class="block px-4 py-3 text-gray-700 hover:bg-pink-50 rounded-lg font-medium {{ request()->routeIs('doctors.*') ? 'bg-pink-50 text-pink-600' : '' }}">Doctors</a>
                <a href="{{ route('services') }}" class="block px-4 py-3 text-gray-700 hover:bg-pink-50 rounded-lg font-medium {{ request()->routeIs('services') ? 'bg-pink-50 text-pink-600' : '' }}">Services</a>
                <a href="{{ route('treatments') }}" class="block px-4 py-3 text-gray-700 hover:bg-pink-50 rounded-lg font-medium {{ request()->routeIs('treatments') ? 'bg-pink-50 text-pink-600' : '' }}">Treatments</a>
                <a href="{{ route('blog.index') }}" class="block px-4 py-3 text-gray-700 hover:bg-pink-50 rounded-lg font-medium {{ request()->routeIs('blog.*') ? 'bg-pink-50 text-pink-600' : '' }}">Blog</a>
                <a href="{{ route('about') }}" class="block px-4 py-3 text-gray-700 hover:bg-pink-50 rounded-lg font-medium {{ request()->routeIs('about') ? 'bg-pink-50 text-pink-600' : '' }}">About</a>
                <a href="{{ route('faq') }}" class="block px-4 py-3 text-gray-700 hover:bg-pink-50 rounded-lg font-medium {{ request()->routeIs('faq') ? 'bg-pink-50 text-pink-600' : '' }}">FAQ</a>
                
                @auth
                    <div class="border-t border-gray-200 pt-3 mt-3">
                        <div class="px-4 py-2 mb-2">
                            <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-pink-50 rounded-lg font-medium">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Dashboard
                        </a>
                        @if(Auth::user()->isPatient())
                        <a href="{{ route('patient.profile') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-pink-50 rounded-lg font-medium">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            My Profile
                        </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg font-medium">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('book-appointment') }}" class="block px-4 py-3 bg-gradient-to-r from-pink-400 to-pink-500 text-white rounded-lg text-center font-semibold">
                        📅 Book Appointment
                    </a>
                    
                    <a href="{{ route('login') }}" class="block px-4 py-3 bg-white text-pink-600 rounded-lg text-center font-semibold border-2 border-pink-300">
                        Sign In
                    </a>
                    
                    <a href="{{ route('register-physiotherapist') }}" class="block px-4 py-3 bg-white text-pink-600 rounded-lg text-center font-semibold border-2 border-pink-300">
                        Join as Physiotherapist
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Location-based search bar (full width, below navbar) - Hidden on mobile on home page, shown elsewhere or modified by children -->
    @if(request()->routeIs('home'))
        @include('partials.search-bar', ['class' => 'hidden md:block'])
    @else
        @include('partials.search-bar')
    @endif

    
    <!-- Main Content: theme background same as home page -->
    <main class="theme-page-bg">
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="bg-gradient-to-br from-gray-900 to-gray-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <div class="mb-4">
                        <img src="{{ asset('images/pelvicarehealth_logo.png') }}" 
                             alt="Pelvicare Health - Women's Health Physiotherapy" 
                             class="h-16 w-auto object-contain"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="hidden items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-pink-400 to-pink-600 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="text-xl font-bold heading-font">Pelvicare<sup class="text-xs text-pink-400">®</sup></div>
                                <div class="text-xs text-gray-400">Women's Health Physiotherapy</div>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm mb-4">Expert care for pelvic health conditions. Empowering women through specialized physiotherapy.</p>
                    <div class="text-gray-400 text-sm">
                        <p class="font-semibold mb-2">Locations:</p>
                        <p>Currently in <strong class="text-white">Delhi NCR, Mumbai, Bangalore, Pune</strong></p>
                    </div>
                </div>
                
                <div>
                    <h3 class="font-semibold mb-4 heading-font text-white">For Women</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="{{ route('services') }}#sexual" class="hover:text-pink-400 transition-colors">Pain During Sex</a></li>
                        <li><a href="{{ route('services') }}#postpartum" class="hover:text-pink-400 transition-colors">Postpartum Recovery</a></li>
                        <li><a href="{{ route('services') }}#pregnancy" class="hover:text-pink-400 transition-colors">Pregnancy Pain</a></li>
                        <li><a href="{{ route('services') }}#bladder" class="hover:text-pink-400 transition-colors">Bladder Issues</a></li>
                        <li><a href="{{ route('services') }}#pelvic" class="hover:text-pink-400 transition-colors">Pelvic Pain</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-semibold mb-4 heading-font text-white">Learn</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="{{ route('home') }}#problems" class="hover:text-pink-400 transition-colors">Is This Normal?</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-pink-400 transition-colors">What to Expect</a></li>
                        <li><a href="{{ route('faq') }}" class="hover:text-pink-400 transition-colors">FAQs</a></li>
                        <li><a href="{{ route('home') }}#testimonials" class="hover:text-pink-400 transition-colors">Success Stories</a></li>
                        <li><a href="{{ route('doctors.index') }}" class="hover:text-pink-400 transition-colors">Our Specialists</a></li>
                        <li><a href="#" class="hover:text-pink-400 transition-colors">Blog</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-semibold mb-4 heading-font text-white">Company</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="{{ route('about') }}" class="hover:text-pink-400 transition-colors">About Us</a></li>
                        <li><a href="{{ route('doctors.index') }}" class="hover:text-pink-400 transition-colors">Find a Doctor</a></li>
                        <li><a href="#" class="hover:text-pink-400 transition-colors">Privacy & Safety</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-pink-400 transition-colors">Contact Us</a></li>
                        <li><a href="#" class="hover:text-pink-400 transition-colors">Partner Clinics</a></li>
                    </ul>
                    <div class="mt-6">
                        <h4 class="font-semibold mb-3 text-white text-sm">Follow Us</h4>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-pink-400 transition-colors" aria-label="Instagram">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-pink-400 transition-colors" aria-label="Facebook">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400 text-sm">
                <p>&copy; {{ date('Y') }} Pelvicare Women Health Physiotherapy. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    
    <script>
        // Mobile menu toggle with proper class handling
        document.addEventListener('DOMContentLoaded', function() {
            const menuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (menuButton && mobileMenu) {
                menuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('active');
                });
                
                // Close menu when clicking outside
                document.addEventListener('click', function(event) {
                    if (!menuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                        mobileMenu.classList.remove('active');
                    }
                });
            }

            // User menu dropdown toggle
            const userMenuButton = document.getElementById('user-menu-button');
            const userMenuDropdown = document.getElementById('user-menu-dropdown');
            const userMenuContainer = document.getElementById('user-menu-container');
            
            if (userMenuButton && userMenuDropdown) {
                userMenuButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    userMenuDropdown.classList.toggle('hidden');
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(event) {
                    if (userMenuContainer && !userMenuContainer.contains(event.target)) {
                        userMenuDropdown.classList.add('hidden');
                    }
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
