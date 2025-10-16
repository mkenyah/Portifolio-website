<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Project: {{ $project->name }} - {{ $project->description }}">

    <title>{{ $project->name }} - {{ config('app.name', 'Portfolio') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            .animate-fade-in {
                animation: fadeIn 1s ease-in-out;
            }
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .gradient-text {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            .hero-bg {
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            }
            .star-rating {
                display: inline-block;
            }
            .star-rating .star {
                color: #ddd;
                font-size: 1.5rem;
            }
            .star-rating .star.filled {
                color: #f59e0b;
            }
        </style>
    @endif
</head>
<body class="font-sans antialiased bg-gradient-to-br from-slate-50 to-blue-50 text-slate-900">
    <nav class="fixed top-0 w-full bg-white/90 backdrop-blur-md border-b border-slate-200/50 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ route('projects.index') }}" class="text-xl font-bold text-slate-900 hover:text-blue-600 transition-all duration-300">Joseph Kirika</a>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="{{ route('projects.index') }}" class="text-slate-600 hover:text-blue-600 transition-all duration-300 font-medium">Home</a>
                    <a href="#comments" class="text-slate-600 hover:text-blue-600 transition-all duration-300 font-medium">Comments</a>
                    <a href="{{ route('contact.show') }}" class="text-slate-600 hover:text-blue-600 transition-all duration-300 font-medium">Contact</a>
                </div>
                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-slate-600 hover:text-blue-600 focus:outline-none focus:text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <!-- Mobile menu -->
            <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-slate-200/50">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="{{ route('projects.index') }}" class="block px-3 py-2 text-slate-600 hover:text-blue-600 hover:bg-slate-50 transition-all duration-300 font-medium">Home</a>
                    <a href="#comments" class="block px-3 py-2 text-slate-600 hover:text-blue-600 hover:bg-slate-50 transition-all duration-300 font-medium">Comments</a>
                    <a href="{{ route('contact.show') }}" class="block px-3 py-2 text-slate-600 hover:text-blue-600 hover:bg-slate-50 transition-all duration-300 font-medium">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-24 pb-16 px-4 sm:px-6 lg:px-8 hero-bg">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-5xl md:text-6xl font-bold gradient-text mb-6 leading-tight">{{ $project->name }}</h1>
            <p class="text-xl md:text-2xl text-slate-600 mb-8 max-w-3xl mx-auto leading-relaxed">{{ $project->description }}</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
                @if($project->live_url)
                <a href="{{ $project->live_url }}" target="_blank" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-full hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl font-semibold">
                    View Live Demo
                </a>
                @endif
                @if($project->github_url)
                <a href="{{ $project->github_url }}" target="_blank" class="border-2 border-blue-600 text-blue-600 px-8 py-3 rounded-full hover:bg-blue-600 hover:text-white transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl font-semibold">
                    View on GitHub
                </a>
                @endif
            </div>
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <div class="flex items-center gap-2">
                    <div class="text-2xl font-bold text-blue-600">{{ $project->likes->count() }}</div>
                    <form action="{{ route('likes.store', $project) }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="text-slate-600 hover:text-red-500 transition-colors duration-200 transform hover:scale-110">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        </button>
                    </form>
                </div>
                <div class="flex items-center gap-4">
                    <div class="star-rating">
                        <form action="{{ route('ratings.store', $project) }}" method="POST" class="inline-block">
                            @csrf
                            <select name="rating" onchange="this.form.submit()" class="border border-slate-300 rounded-md p-1 text-lg cursor-pointer">
                                <option value="" disabled selected>Rate this project</option>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                                @endfor
                            </select>
                        </form>
                    </div>
                    <div class="text-lg font-semibold text-slate-700">{{ number_format($averageRating, 1) }}/5</div>
                </div>
                <a href="#comments" class="text-slate-600 hover:text-blue-600 transition-colors duration-200 transform hover:scale-110">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                </a>
            </div>
        </div>
    </section>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 animate-fade-in">
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-4">Technologies</h2>
                <div class="flex flex-wrap gap-3">
                    @if($project->technologies && is_array($project->technologies))
                        @foreach($project->technologies as $tech)
                            <span class="bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 px-4 py-2 rounded-full text-sm font-medium hover:scale-105 transition-transform duration-200">{{ $tech }}</span>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="mb-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-4">Average Rating</h2>
                <div class="flex items-center gap-4">
                    <div class="star-rating">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="star {{ $i <= round($averageRating) ? 'filled' : '' }}">★</span>
                        @endfor
                    </div>
                    <div class="text-2xl font-bold text-blue-600">{{ number_format($averageRating, 1) }}</div>
                    <div class="text-slate-500">/ 5</div>
                </div>
            </div>
        </div>

        <section id="comments" class="bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-slate-900 mb-6">Comments</h2>
            @forelse($project->comments as $comment)
                <div class="mb-6 p-4 bg-slate-50 rounded-xl border border-slate-200 hover:shadow-md transition-shadow duration-200">
                    <p class="text-slate-700 mb-2 leading-relaxed">{{ $comment->content }}</p>
                    <small class="text-slate-500 font-medium">Posted on {{ $comment->created_at->format('M d, Y') }}</small>
                </div>
            @empty
                <p class="text-slate-500 text-center py-8">No comments yet.</p>
            @endforelse

            <form action="{{ route('comments.store', $project) }}" method="POST" class="mt-8">
                @csrf
                <input type="text" name="name" required placeholder="Your name" class="w-full p-2 border border-slate-300 rounded-xl mb-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" />
                <textarea name="message" rows="4" class="w-full p-4 border border-slate-300 rounded-xl mb-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" placeholder="Add a comment..."></textarea>
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl font-semibold">Submit Comment</button>
            </form>
        </section>
    </main>

    <!-- Mobile Menu JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });

            // Close mobile menu when clicking on a link
            const mobileMenuLinks = mobileMenu.querySelectorAll('a');
            mobileMenuLinks.forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.add('hidden');
                });
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                    mobileMenu.classList.add('hidden');
                }
            });
        });
    </script>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white py-12 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h3 class="text-2xl font-bold mb-4">Joseph Kirika</h3>
                <p class="text-slate-400 mb-6 max-w-2xl mx-auto">Full-stack developer passionate about creating innovative solutions and beautiful user experiences.</p>
                <div class="flex justify-center space-x-6">
                    <a href="{{ route('projects.index') }}" class="text-slate-400 hover:text-white transition-colors duration-200">Home</a>
                    <a href="#comments" class="text-slate-400 hover:text-white transition-colors duration-200">Comments</a>
                    <a href="{{ route('contact.show') }}" class="text-slate-400 hover:text-white transition-colors duration-200">Contact</a>
                </div>
                <div class="mt-8 pt-8 border-t border-slate-800">
                    <p class="text-slate-500 text-sm">&copy; {{ date('Y') }} Joseph Kirika. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
