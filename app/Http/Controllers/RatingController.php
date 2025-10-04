<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $rating = new Rating($validated);
        $rating->project()->associate($project);
        $rating->save();

        return redirect()->route('projects.show', $project)->with('success', 'Rating submitted successfully.');
    }
}
