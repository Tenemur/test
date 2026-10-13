<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Application $application)
    {
        $validated = $request->validate([
            'content' => 'required|max:255',
        ]);

        $review = new Review;
        $review->content = $request->content;
        $review->user_id = Auth::id();
        $review->application_id = $application->id;
        $review->save();
        return redirect()->route('applications.index');
    }
}
