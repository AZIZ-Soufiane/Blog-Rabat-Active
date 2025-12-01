@session('deleteSuccess')
    <div id="dismiss-alert" class="hs-removing:translate-x-5 hs-removing:opacity-0 transition duration-300 bg-red-50 border border-red-200 text-sm text-red-800 rounded-lg p-4" role="alert" tabindex="-1" aria-labelledby="hs-dismiss-button-label">
    <div class="flex">
        <div class="shrink-0">
        <svg class="shrink-0 size-4 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <path d="M12 8v4"></path>
            <path d="M12 16h.01"></path>
        </svg>
        </div>
        <div class="ms-2">
        <h3 id="hs-dismiss-button-label" class="text-sm font-medium">
            {{ session('deleteSuccess') }}
        </h3>
        </div>
        <div class="ps-3 ms-auto">
        <div class="-mx-1.5 -my-1.5">
            <button 
            type="button" 
            class="inline-flex bg-red-50 rounded-lg p-1.5 text-red-500 hover:bg-red-100 focus:outline-hidden focus:bg-red-100" 
            data-hs-remove-element="#dismiss-alert"
            >
            <span class="sr-only">Dismiss</span>
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6 6 18"></path>
                <path d="m6 6 12 12"></path>
            </svg>
            </button>
        </div>
        </div>
    </div>
    </div>
@endsession
