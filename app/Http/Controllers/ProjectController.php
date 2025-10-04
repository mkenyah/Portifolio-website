<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        // Only fetch from GitHub if token is set
        if (env('GITHUB_TOKEN')) {
            $this->fetchProjectsFromGitHub();
        }

        // Fetch projects from database ordered by latest github_time descending with pagination
        $projects = Project::with(['ratings', 'likes'])->orderByRaw('github_time DESC')->paginate(9);

        // Calculate average rating and likes count for each project
        $projects->getCollection()->transform(function ($project) {
            $project->averageRating = $project->ratings->avg('rating') ?? 0;
            $project->likesCount = $project->likes->count();
            return $project;
        });

        // Fetch profile data
        $profile = \App\Models\Profile::first();

        return view('welcome', compact('projects', 'profile'));
    }

    public function show(Project $project)
    {
        $project->load(['comments', 'likes', 'ratings']);

        // Calculate average rating
        $averageRating = $project->ratings->avg('rating') ?? 0;

        return view('project', compact('project', 'averageRating'));
    }

    private function fetchProjectsFromGitHub()
    {
        // Use the Artisan command to fetch all repositories including private ones
        Artisan::call('fetch:github-repos');

        // After fetching, read the saved JSON file
        if (!Storage::exists('mkenyah_repos.json')) {
            return; // Skip if file doesn't exist
        }
        $reposJson = Storage::get('mkenyah_repos.json');
        $allRepos = json_decode($reposJson, true);
        if (!is_array($allRepos)) {
            return; // Skip if not array
        }

        // Sort repos by GitHub updated_at descending (latest first)
        usort($allRepos, function($a, $b) {
            return strtotime($b['updated_at']) <=> strtotime($a['updated_at']);
        });

        // Sync the fetched repos to the database
        foreach ($allRepos as $repo) {
            // Find existing project by github_url
            $existingProject = Project::where('github_url', $repo['html_url'])->first();

            Project::updateOrCreate(
                ['github_url' => $repo['html_url']],
                [
                    'name' => $repo['name'],
                    'description' => $repo['description'] ?? 'No description available',
                    'technologies' => $this->extractTechnologies($repo),
                    'live_url' => null, // Can be set manually later
                    // Preserve existing image_url if present, else null
                    'image_url' => $existingProject ? $existingProject->image_url : null,
                    'is_github' => true,
                    'created_at' => $repo['created_at'] ?? now(),
                    'updated_at' => $repo['updated_at'] ?? now(),
                    'github_time' => date('Y-m-d H:i:s', strtotime($repo['updated_at'] ?? now())),
                ]
            );
        }

        // Return projects ordered by latest created first
        return Project::orderBy('created_at', 'desc')->get();
    }

    private function extractTechnologies($repo)
    {
        // Simple extraction based on repo topics or language
        $technologies = [];

        if (isset($repo['language'])) {
            $technologies[] = $repo['language'];
        }

        if (isset($repo['topics'])) {
            $technologies = array_merge($technologies, $repo['topics']);
        }

        return array_unique($technologies);
    }
}
