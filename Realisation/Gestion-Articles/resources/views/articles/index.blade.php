@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-bold mb-4">Articles</h2>

@session('Success')

    <div class="py-5 px-2 position absolute z-50 w-2xl"></div>
        @include('Alerts.Alert_Successfull')
    </div>
@endsession

  
@session('deleteSuccess')

      <div class="py-5 px-2 position absolute z-50 w-2xl"></div>
        @include('Alerts.Alert_Failed')
      </div>
@endsession

  
<form method="GET" action="{{ route('articles.index') }}" class="flex gap-2 mb-4 justify-between">
   


<div class="flex gap-1">
      <!-- SearchBox -->
      <div class="relative w-xl ">
        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-3.5">
          <svg class="shrink-0 size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <path d="m21 21-4.3-4.3"></path>
          </svg>
        </div>
        <input id="searchInput" class="py-2.5 py-3 ps-10 pe-4 block w-full border border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" type="text" role="combobox" aria-expanded="false" placeholder="Type a name" value="{{ request('search') }}" data-hs-combo-box-input="">
      </div>

      <select 
          name="category" 
          id="category" 
          onchange="this.form.submit()" 
          class="py-2.5 py-3 ps-10 pe-4 block w-1xl border border-gray-200 rounded-lg sm:text-sm focus:border-black-500 focus:ring-black-500 disabled:opacity-50 disabled:pointer-events-none"
      >
          <option value="" {{ request('category') == '' ? 'selected' : '' }}>All Categories</option>
          @foreach($categories as $category)
              <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                  {{ $category->name }}
              </option>
          @endforeach
      </select>
</div>

<div>
  <button type="button" class="py-2.5 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
      <a href="{{ route('articles.create') }}">
        Add article
      </a>
  </button>
</div>


</form>


<div class="flex flex-col border border-gray-300 p-6 rounded-xl">
  <div class="-m-1.5 overflow-x-auto">
    <div class="p-1.5 min-w-full inline-block align-middle">
      <div class="overflow-hidden rounded-lg">
        
       <table class="min-w-full divide-y divide-gray-200 table-fixed rounded-lg">
          <thead>
            <tr>
              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Title</th>
              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Categories</th>
              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Statut</th>
              <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200" >
             @foreach($articles as $article)
            <tr class="article-item" data-title="{{ strtolower($article->title) }}">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $article->title }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                @foreach($article->categories as $cat)
                    <span class="bg-gray-200 px-2 py-1 rounded-md">{{ $cat->name }}</span>
                @endforeach
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                {{ $article->statut }}
              </td>

              <td class="whitespace-nowrap text-end text-sm font-medium px-4 py-2">
                  <div class="flex gap-2 justify-end">
                      <!-- Delete Form with Icon -->
                      <form method="POST" action="{{ route('articles.destroy', $article->id) }}">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="flex items-center gap-1 bg-rose-600 hover:bg-rose-700 text-white px-2 py-1 rounded-lg text-sm transition-colors duration-200">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                              </svg>
                              Delete
                          </button>
                      </form>

                      <!-- Edit Link with Icon -->
                      <a href="{{ route('articles.edit', $article->id) }}" class="flex items-center gap-1 bg-emerald-600 hover:bg-emerald-700 text-white px-2 py-1 rounded-lg text-sm transition-colors duration-200">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17h2m-1-1V5m4 12h2m-1-1V9m-6 8h2m-1-1V7"/>
                          </svg>
                          Edit
                      </a>
                  </div>
              </td>

              
            </tr>
            @endforeach
        
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


{{ $articles->withQueryString()->links() }}
@endsection
