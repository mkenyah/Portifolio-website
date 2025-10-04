<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Project;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $comment = new Comment($validated);
        $comment->project()->associate($project);
        $comment->save();

        return redirect()->route('projects.show', $project)->with('success', 'Comment added successfully.');
    }
}
