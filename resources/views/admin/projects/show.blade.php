@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Project Details</h1>
        <div class="space-x-4">
            <a href="{{ route('admin.projects.edit', $project) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors">
                Edit Project
            </a>
            <a href="{{ route('admin.projects.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                Back to Projects
            </a>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Project Information</h3>
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Name</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $project->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Description</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $project->description }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Technologies</dt>
                            <dd class="mt-1">
                                @if($project->technologies && is_array($project->technologies))
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($project->technologies as $tech)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $tech }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-sm text-gray-500">No technologies specified</span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Source</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @if($project->is_github)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        GitHub Repository
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Manual Entry
                                    </span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">GitHub URL</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @if($project->github_url)
                                    <a href="{{ $project->github_url }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                        {{ $project->github_url }}
                                    </a>
                                @else
                                    <span class="text-gray-500">Not provided</span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Live URL</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @if($project->live_url)
                                    <a href="{{ $project->live_url }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                        {{ $project->live_url }}
                                    </a>
                                @else
                                    <span class="text-gray-500">Not provided</span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Created At</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $project->created_at->format('M d, Y H:i') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Updated At</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $project->updated_at->format('M d, Y H:i') }}</dd>
                        </div>
                    </dl>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Project Media</h3>
                    @if($project->image_url)
                        <div class="mb-4">
                            @if(strpos($project->image_url, '.mp4') !== false || strpos($project->image_url, '.avi') !== false || strpos($project->image_url, '.mov') !== false)
                                <video controls class="max-w-full h-auto rounded-lg shadow">
                                    <source src="{{ asset('storage/' . $project->image_url) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                <img src="{{ asset('storage/' . $project->image_url) }}" alt="{{ $project->name }}" class="max-w-full h-auto rounded-lg shadow" />
                            @endif
                        </div>
                    @else
                        <div class="bg-gray-100 rounded-lg p-8 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-500">No media uploaded</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
