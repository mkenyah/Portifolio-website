<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Project;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $like = new Like();
        $like->project()->associate($project);
        $like->save();

        return redirect()->route('projects.show', $project)->with('success', 'Project liked successfully.');
    }
}
