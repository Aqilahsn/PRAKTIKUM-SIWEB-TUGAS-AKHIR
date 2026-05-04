<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Gudang - Admin</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e40af', // Blue
                        secondary: '#0ea5e9', // Light Blue
                        danger: '#dc2626', // Red
                        success: '#16a34a', // Green
                    },
                    fontFamily: {
                        heading: ['"Playfair Display"', 'serif'],
                        body: ['"Inter"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
        h1, h2, h3, h4, h5, h6, .font-heading {
            font-family: 'Playfair Display', serif;
        }
        .btn-primary {
            background-color: #1e40af;
            color: white;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
        }
        .btn-primary:hover {
            background-color: #1e3a8a;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .btn-success {
            background-color: #16a34a;
            color: white;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
        }
        .btn-success:hover {
            background-color: #15803d;
        }
        .btn-danger {
            background-color: #dc2626;
            color: white;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
        }
        .btn-danger:hover {
            background-color: #b91c1c;
        }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-primary text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('dashboard') }}" class="font-heading text-2xl font-bold">
                Gudang Manager
            </a>
            <div class="flex items-center space-x-6 text-sm font-medium">
                @auth
                    <a href="{{ route('products.index') }}" class="hover:text-secondary transition">Dashboard</a>
                    <span class="text-gray-300">|</span>
                    <span class="font-bold">{{ Auth::user()->name }}</span>
                    <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Admin</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-red-300 transition">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-secondary transition">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow max-w-7xl mx-auto w-full py-8 px-6">
        @if(session('success'))
            <div class="mb-6 px-4 py-3 bg-green-100 border-l-4 border-success text-success rounded-lg shadow-sm">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="mb-6 px-4 py-3 bg-red-100 border-l-4 border-danger text-danger rounded-lg shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center py-4 text-gray-600 text-sm border-t border-gray-200">
        &copy; {{ date('Y') }} Sistem Manajemen Gudang. Admin Dashboard.
    </footer>

</body>
</html>
