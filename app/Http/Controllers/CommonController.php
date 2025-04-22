<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function index(Request $request)
{
    $categoryId = $request->query('category_id');

    $categories = Category::all();

    $newsQuery = News::with('comments');

    if ($categoryId) {
        $newsQuery->where('category_id', $categoryId);
    }

    $newsList = $newsQuery->latest()->get();

    return view('common.welcome', compact('newsList', 'categories'));
}

public function storeComment(Request $request)
    {
        $request->validate([
            'news_id' => 'required|exists:news,id',
            'comment' => 'required|string|max:1000',
        ]);

       
        Comment::create([
            'news_id' => $request->news_id,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }
}
