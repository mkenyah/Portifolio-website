<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('github_time', 'desc')->paginate(20);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'technologies' => 'nullable|array',
            'github_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_url'] = $request->file('image')->store('projects', 'public');
        }

        $validated['technologies'] = json_encode($validated['technologies'] ?? []);
        $validated['is_github'] = false;

        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'technologies' => 'nullable|string',
            'github_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,avi,mov|max:20480',
        ]);

        if ($request->hasFile('image')) {
            if ($project->image_url) {
                Storage::disk('public')->delete($project->image_url);
            }
            $validated['image_url'] = $request->file('image')->store('projects', 'public');
        }

        // Process technologies from comma-separated string to array
        if ($project->is_github) {
            // For GitHub projects, keep the existing technologies
            $validated['technologies'] = $project->technologies;
        } else {
            $technologies = [];
            if ($validated['technologies']) {
                $technologies = array_map('trim', explode(',', $validated['technologies']));
                $technologies = array_filter($technologies); // Remove empty values
            }
            $validated['technologies'] = json_encode($technologies);
        }

        // Keep old image_url if no new image uploaded
        if (!isset($validated['image_url'])) {
            $validated['image_url'] = $project->image_url;
        }

        // Update github_time to current timestamp on manual update
        $validated['github_time'] = now();

        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if ($project->image_url) {
            Storage::disk('public')->delete($project->image_url);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}
