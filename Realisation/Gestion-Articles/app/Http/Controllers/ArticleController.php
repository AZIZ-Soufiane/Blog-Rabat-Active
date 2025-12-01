<?php

// app/Http/Controllers/ArticleController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $articles = Article::query();

    
        if ($request->has('category') && $request->category != '') {
            $categorySlug = $request->category;

            $articles->whereHas('categories', function ($q) use ($categorySlug) {
                $q->where('categories.slug', $categorySlug); // <- Use table name to avoid ambiguity
            });
        }

        $articles = $articles->paginate(10);

        return view('articles.index', compact('articles', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'statut' => 'required|in:draft,published,archived',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id'
        ]);

        $article = Article::create($validated);

        if (!empty($validated['categories'])) {
            $article->categories()->attach($validated['categories']);
        }

        return redirect()->route('articles.index')->with('success', 'Article created successfully.')->with('Success','Data added successfully');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::all();
        return view('articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'statut' => 'required|in:draft,published,archived',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id'
        ]);

        $article->update($validated);

        $article->categories()->sync($validated['categories'] ?? []);

        return redirect()->route('articles.index')->with('Success', 'Article updated successfully.');
    }

    public function destroy($id)
{
    $article = Article::findOrFail($id);
    $article->categories()->detach();
    $title = $article->title;
    $article->delete();
    return redirect()
        ->route('articles.index')
        ->with('deleteSuccess', 'Article '.$title . ' deleted successfully.');
    }

}

