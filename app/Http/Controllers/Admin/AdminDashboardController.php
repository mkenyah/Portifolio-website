<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Comment;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Analytics data
        $totalProjects = Project::count();
        $totalComments = Comment::count();
        $totalMessages = ContactMessage::count();
        $totalLikes = Project::withCount('likes')->get()->sum('likes_count');

        // Top rated projects
        $topRatedProjects = Project::withCount(['ratings', 'likes', 'comments'])
            ->get()
            ->map(function ($project) {
                $averageRating = $project->ratings->avg('rating') ?? 0;
                return [
                    'project' => $project,
                    'average_rating' => $averageRating,
                    'likes_count' => $project->likes_count,
                    'comments_count' => $project->comments_count,
                ];
            })
            ->sortByDesc('average_rating')
            ->take(10);

        // Recent comments
        $recentComments = Comment::with('project')->latest()->take(5)->get();

        // Recent messages
        $recentMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProjects',
            'totalComments',
            'totalMessages',
            'totalLikes',
            'topRatedProjects',
            'recentComments',
            'recentMessages'
        ));
    }
}
