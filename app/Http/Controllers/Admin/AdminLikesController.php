<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;

class AdminLikesController extends Controller
{
    public function index()
    {
        $likes = Like::with(['project'])->paginate(20);
        return view('admin.likes.index', compact('likes'));
    }

    public function destroy(Like $like)
    {
        $like->delete();
        return redirect()->route('admin.likes.index')->with('success', 'Like deleted successfully.');
    }
}
