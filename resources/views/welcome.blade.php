<!DOCTYPE html>
@php use Illuminate\Support\Str; @endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Portfolio of Joseph Kirika - Full Stack Developer showcasing projects and skills" />

    <title>{{ config('app.name', 'Joseph Kirika - Portfolio') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
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
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
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
        </style>
    @endif
</head>
<body class="font-sans antialiased bg-gradient-to-br from-slate-50 to-blue-50 text-slate-900">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full bg-white/90 backdrop-blur-md border-b border-slate-200/50 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="/" class="text-xl font-bold text-slate-900 hover:text-blue-600 transition-all duration-300">Joseph Kirika</a>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="#about" class="text-slate-600 hover:text-blue-600 transition-all duration-300 font-medium">About</a>
                    <a href="#projects" class="text-slate-600 hover:text-blue-600 transition-all duration-300 font-medium">Projects</a>
                    <a href="#contact" class="text-slate-600 hover:text-blue-600 transition-all duration-300 font-medium">Contact</a>
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
                    <a href="#about" class="block px-3 py-2 text-slate-600 hover:text-blue-600 hover:bg-slate-50 transition-all duration-300 font-medium">About</a>
                    <a href="#projects" class="block px-3 py-2 text-slate-600 hover:text-blue-600 hover:bg-slate-50 transition-all duration-300 font-medium">Projects</a>
                    <a href="#contact" class="block px-3 py-2 text-slate-600 hover:text-blue-600 hover:bg-slate-50 transition-all duration-300 font-medium">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-24 pb-20 px-4 sm:px-6 lg:px-8 hero-bg">
        <div class="max-w-7xl mx-auto">
            <div class="text-center animate-fade-in">
                <h1 class="text-4xl sm:text-5xl md:text-7xl font-bold gradient-text mb-6 leading-tight">
                    Full Stack Developer
                </h1>
                <p class="text-lg sm:text-xl md:text-2xl text-slate-600 mb-10 max-w-3xl mx-auto leading-relaxed">
                    I create exceptional digital experiences with modern technologies.
                    Passionate about clean code, user experience, and innovative solutions.
                </p>
                <div class="flex flex-col sm:flex-row gap-6 justify-center">
                    <a href="#projects" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 sm:px-10 py-4 rounded-full hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl font-semibold text-center">
                        View My Work
                    </a>
                    <a href="#contact" class="border-2 border-blue-600 text-blue-600 px-8 sm:px-10 py-4 rounded-full hover:bg-blue-600 hover:text-white transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl font-semibold text-center">
                        Get In Touch
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 px-4 sm:px-6 lg:px-8 bg-white animate-fade-in">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-8">About Me</h2>
                    <p class="text-base sm:text-lg text-slate-600 mb-6 leading-relaxed">
                        I'm a passionate full stack developer with expertise in modern web technologies.
                        I love building scalable applications and solving complex problems.
                    </p>
                    <p class="text-base sm:text-lg text-slate-600 mb-8 leading-relaxed">
                        My journey in software development has equipped me with skills in both frontend
                        and backend technologies, allowing me to create complete, end-to-end solutions.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <span class="bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 px-4 py-2 rounded-full text-xs sm:text-sm font-medium hover:scale-105 transition-transform duration-200">HTML</span>
                        <span class="bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 px-4 py-2 rounded-full text-xs sm:text-sm font-medium hover:scale-105 transition-transform duration-200">CSS</span>
                        <span class="bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 px-4 py-2 rounded-full text-xs sm:text-sm font-medium hover:scale-105 transition-transform duration-200">JavaScript</span>
                        <span class="bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 px-4 py-2 rounded-full text-xs sm:text-sm font-medium hover:scale-105 transition-transform duration-200">React</span>
                        <span class="bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 px-4 py-2 rounded-full text-xs sm:text-sm font-medium hover:scale-105 transition-transform duration-200">Laravel</span>
                        <span class="bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 px-4 py-2 rounded-full text-xs sm:text-sm font-medium hover:scale-105 transition-transform duration-200">PHP</span>
                        <span class="bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 px-4 py-2 rounded-full text-xs sm:text-sm font-medium hover:scale-105 transition-transform duration-200">Django</span>
                        <span class="bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 px-4 py-2 rounded-full text-xs sm:text-sm font-medium hover:scale-105 transition-transform duration-200">Python</span>
                        <span class="bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 px-4 py-2 rounded-full text-xs sm:text-sm font-medium hover:scale-105 transition-transform duration-200">C</span>
                        <span class="bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 px-4 py-2 rounded-full text-xs sm:text-sm font-medium hover:scale-105 transition-transform duration-200">C++</span>
                        <span class="bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 px-4 py-2 rounded-full text-xs sm:text-sm font-medium hover:scale-105 transition-transform duration-200">MySQL</span>
                        <span class="bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 px-4 py-2 rounded-full text-xs sm:text-sm font-medium hover:scale-105 transition-transform duration-200">SQLite</span>
                        <span class="bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 px-4 py-2 rounded-full text-xs sm:text-sm font-medium hover:scale-105 transition-transform duration-200">Java</span>
                        <span class="bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 px-4 py-2 rounded-full text-xs sm:text-sm font-medium hover:scale-105 transition-transform duration-200">Tailwind CSS</span>
                        <span class="bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 px-4 py-2 rounded-full text-xs sm:text-sm font-medium hover:scale-105 transition-transform duration-200">Bootstrap</span>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-slate-100 to-slate-200 h-64 sm:h-80 md:h-96 rounded-2xl flex items-center justify-center shadow-lg hover:shadow-xl transition-shadow duration-300">
                    @if($profile && $profile->profile_picture)
                        <img src="{{ asset('storage/' . $profile->profile_picture) }}" alt="Profile Image" class="rounded-full object-cover h-64 w-64" />
                    @else
                        <span class="text-slate-500 text-lg font-medium">Profile Image Placeholder</span>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-20 px-4 sm:px-6 lg:px-8 bg-slate-50 animate-fade-in">
        <div class="max-w-7xl mx-auto">
             <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-16 text-center">Featured Projects</h2>
             <div class="text-3xl sm:text-4xl font-bold mb-3 text-blue-400 group-hover:scale-110 transition-transform duration-300">{{ $projects->total() ?? 0 }}</div>
             <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                 @forelse($projects ?? [] as $project)
                 <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-slate-100">
                     <div class="aspect-[4/3] bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center overflow-hidden rounded-lg shadow-md">
                         @if($project->image_url)
                             <img src="{{ asset('storage/' . $project->image_url) }}" alt="{{ $project->name }} Image" class="w-full h-full object-contain rounded-lg" />
                         @else
                             <span class="text-slate-500 text-lg font-medium">Project Image</span>
                         @endif
                     </div>
                    <div class="p-6 sm:p-8">
                        <h3 class="text-xl sm:text-2xl font-bold text-slate-900 mb-3">{{ $project->name }}</h3>
                        <p class="text-slate-600 mb-6 leading-relaxed">{{ Str::limit($project->description, 120) }}</p>
                        <div class="flex flex-wrap gap-2 mb-6">
                            @if($project->technologies && is_array($project->technologies))
                                @foreach($project->technologies as $tech)
                                <span class="bg-gradient-to-r from-blue-50 to-purple-50 text-blue-700 px-3 py-1 rounded-full text-xs sm:text-sm font-medium">{{ $tech }}</span>
                                @endforeach
                            @endif
                        </div>
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center space-x-1">
                                @php
                                    $fullStars = floor($project->averageRating);
                                    $halfStar = ($project->averageRating - $fullStars) >= 0.5;
                                    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                @endphp
                                @for ($i = 0; $i < $fullStars; $i++)
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.974a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.38 2.455a1 1 0 00-.364 1.118l1.287 3.974c.3.922-.755 1.688-1.54 1.118l-3.38-2.455a1 1 0 00-1.175 0l-3.38 2.455c-.784.57-1.838-.196-1.539-1.118l1.287-3.974a1 1 0 00-.364-1.118L2.037 9.4c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.974z"/></svg>
                                @endfor
                                @if ($halfStar)
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 15l-3.09 1.62.59-3.44L5 11l3.45-.5L10 7l1.55 3.5L15 11l-2.5 2.18.59 3.44z"/></svg>
                                @endif
                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.974a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.38 2.455a1 1 0 00-.364 1.118l1.287 3.974c.3.922-.755 1.688-1.54 1.118l-3.38-2.455a1 1 0 00-1.175 0l-3.38 2.455c-.784.57-1.838-.196-1.539-1.118l1.287-3.974a1 1 0 00-.364-1.118L2.037 9.4c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.974z"/></svg>
                                @endfor
                            </div>
                            <span class="text-sm font-semibold text-slate-700">{{ number_format($project->averageRating, 1) }}/5</span>
                        </div>
                        <div class="flex justify-between items-center space-x-4">
                            <a href="{{ route('projects.show', $project) }}" class="text-blue-600 hover:text-blue-800 font-semibold transition-colors duration-200">View Details →</a>
                            @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" class="text-slate-500 hover:text-slate-700 transition-colors duration-200">
                                <svg class="w-5 h-5 inline" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                            </a>
                            @endif
                            <div class="flex items-center space-x-1 text-slate-600">
                                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/></svg>
                                <span class="text-sm font-semibold">{{ $project->likesCount }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-16">
                    <p class="text-slate-500 text-lg">No projects available yet.</p>
                </div>
                @endforelse
            </div>
            <div class="mt-12 flex justify-center">
                {{ $projects->links() }}
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-slate-900 to-slate-800 text-white animate-fade-in">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="group">
                    <div class="text-3xl sm:text-4xl font-bold mb-3 text-blue-400 group-hover:scale-110 transition-transform duration-300">{{ $projects->total() ?? 0 }}</div>
                    <div class="text-slate-300 font-medium">Projects Completed</div>
                </div>
                <div class="group">
                    <div class="text-3xl sm:text-4xl font-bold mb-3 text-purple-400 group-hover:scale-110 transition-transform duration-300">5+</div>
                    <div class="text-slate-300 font-medium">Years Experience</div>
                </div>
                <div class="group">
                    <div class="text-3xl sm:text-4xl font-bold mb-3 text-green-400 group-hover:scale-110 transition-transform duration-300">10+</div>
                    <div class="text-slate-300 font-medium">Technologies</div>
                </div>
                <div class="group">
                    <div class="text-3xl sm:text-4xl font-bold mb-3 text-pink-400 group-hover:scale-110 transition-transform duration-300">50+</div>
                    <div class="text-slate-300 font-medium">Happy Clients</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Preview Section -->
    <section id="contact" class="py-20 px-4 sm:px-6 lg:px-8 bg-white animate-fade-in">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-8">Let's Work Together</h2>
            <p class="text-base sm:text-lg text-slate-600 mb-10 leading-relaxed max-w-3xl mx-auto">
                Have a project in mind? I'd love to hear about it and discuss how we can bring your ideas to life.
            </p>
            <a href="{{ route('contact.show') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 sm:px-10 py-4 rounded-full hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl font-semibold inline-block">
                Get In Touch
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-slate-900 to-slate-800 text-white py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div>
                    <h3 class="text-2xl font-bold mb-6">Joseph Kirika</h3>
                    <p class="text-slate-300 mb-6 leading-relaxed">
                        Full Stack Developer passionate about creating exceptional digital experiences.
                    </p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-6">Quick Links</h4>
                    <ul class="space-y-3 text-slate-300">
                        <li><a href="#about" class="hover:text-blue-400 transition-colors duration-200 font-medium">About</a></li>
                        <li><a href="#projects" class="hover:text-blue-400 transition-colors duration-200 font-medium">Projects</a></li>
                        <li><a href="{{ route('contact.show') }}" class="hover:text-blue-400 transition-colors duration-200 font-medium">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-6">Connect</h4>
                    <div class="flex space-x-6">
                        <a href="https://wa.link/vd6nxf" target="_blank" class="text-slate-300 hover:text-green-500 transition-colors duration-200" aria-label="WhatsApp">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                            </svg>
                        </a>
                        <a href="https://www.tiktok.com/@daily_tech_1with_jose?_t=ZM-90F1JBBxEHg&_r=1" target="_blank" class="text-slate-300 hover:text-pink-600 transition-colors duration-200" aria-label="TikTok">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-slate-300 hover:text-blue-400 transition-colors duration-200" aria-label="GitHub">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5-373-12-12-12z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-slate-700 mt-12 pt-8 text-center text-slate-400">
                <p>&copy; {{ date('Y') }} Joseph Kirika. All rights reserved.</p>
            </div>
        </div>
    </footer>

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
</body>
</html>
