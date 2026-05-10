<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User; // Make sure to import the User model
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('user')->latest()->paginate(10);
        return view('news.index', compact('news'));
    }

    public function create()
    {
        // Fetch all users to populate the author dropdown
        $users = User::orderBy('name')->get();
        return view('news.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'user_id' => 'required|exists:users,id', // Validate the selected user
        ]);

        News::create($validated);

        return redirect()->route('news.index')->with('success', 'News item created successfully.');
    }

    public function show(News $news)
    {
        $news->load('user');
        return view('news.show', compact('news'));
    }

    public function edit(News $news)
    {
        // Fetch all users to populate the author dropdown
        $users = User::orderBy('name')->get();
        return view('news.edit', compact('news', 'users'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'user_id' => 'required|exists:users,id', // Validate the selected user
        ]);

        $news->update($validated);

        return redirect()->route('news.index')->with('success', 'News item updated successfully.');
    }

    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('news.index')->with('success', 'News item deleted successfully.');
    }
}