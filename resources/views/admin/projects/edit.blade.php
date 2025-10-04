@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-6">Edit Project</h1>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Project Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $project->name) }}" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description', $project->description) }}</textarea>
        </div>

        <div>
            <label for="technologies" class="block text-sm font-medium text-gray-700">Technologies (comma separated)</label>
            @if($project->is_github)
                <div class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 px-3 py-2 text-sm text-gray-700">
                    {{ is_array($project->technologies) ? implode(', ', $project->technologies) : $project->technologies }}
                </div>
                <input type="hidden" name="technologies" value="{{ is_array($project->technologies) ? implode(',', $project->technologies) : $project->technologies }}" />
                <p class="text-xs text-gray-500 mt-1">Technologies are fetched from GitHub and cannot be edited.</p>
            @else
                <input type="text" name="technologies" id="technologies" value="{{ old('technologies', is_array($project->technologies) ? implode(',', $project->technologies) : $project->technologies) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                <p class="text-xs text-gray-500 mt-1">Separate technologies with commas, e.g. PHP, Laravel, Vue.js</p>
            @endif
        </div>

        <div>
            <label for="github_url" class="block text-sm font-medium text-gray-700">GitHub URL</label>
            <input type="url" name="github_url" id="github_url" value="{{ old('github_url', $project->github_url) }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
        </div>

        <div>
            <label for="live_url" class="block text-sm font-medium text-gray-700">Live URL</label>
            <input type="url" name="live_url" id="live_url" value="{{ old('live_url', $project->live_url) }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-gray-700">Project Image</label>
            @if ($project->image_url)
                <img src="{{ asset('storage/' . $project->image_url) }}" alt="Project Image" class="mb-2 max-h-48 rounded-md" />
            @endif
            <input type="file" name="image" id="image" accept="image/*,video/*"
                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                file:rounded-md file:border-0 file:text-sm file:font-semibold
                file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
            <p class="text-xs text-gray-500 mt-1">You can upload images or videos (jpeg, png, jpg, gif, mp4, etc.)</p>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Update Project
            </button>
        </div>
    </form>
</div>
@endsection
