@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Articles</h1>

    <form method="GET" action="{{ route('articles.index') }}" class="flex items-center space-x-2">
        <label class="font-medium text-gray-700">Filter:</label>
        <select name="category" onchange="this.form.submit()"
            class="p-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ $selectedCategory == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </form>
</div>

@if(session('success'))
<div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg shadow-sm">
    {{ session('success') }}
</div>
@endif

<div class="overflow-x-auto bg-white shadow-lg rounded-lg">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categories</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($articles as $article)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm text-gray-700">{{ $article->id }}</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $article->title }}</td>
                <td class="px-6 py-4">
                    @foreach($article->categories as $cat)
                        <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs mr-1 mb-1">
                            {{ $cat->name }}
                        </span>
                    @endforeach
                </td>
                <td class="px-6 py-4 text-sm capitalize text-gray-700">{{ $article->status }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $article->created_at->format('Y-m-d') }}</td>
                <td class="px-6 py-4">
                    <form method="POST" action="{{ route('articles.destroy', $article) }}"
                        onsubmit="return confirm('Are you sure you want to delete this article?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none focus:ring focus:ring-red-200 transition">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $articles->links() }}
</div>

@endsection
