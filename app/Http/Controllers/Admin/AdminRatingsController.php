<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;

class AdminRatingsController extends Controller
{
    public function index()
    {
        $ratings = Rating::with(['user', 'project'])->paginate(20);
        return view('admin.ratings.index', compact('ratings'));
    }

    public function destroy(Rating $rating)
    {
        $rating->delete();
        return redirect()->route('admin.ratings.index')->with('success', 'Rating deleted successfully.');
    }
}
