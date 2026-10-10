<section id="location-search-bar" class="bg-white border-b border-gray-100 shadow-sm {{ $class ?? '' }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <form action="{{ route('doctors.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3 sm:gap-0">
            <!-- Location -->
            <div class="flex-1 sm:max-w-[200px] lg:max-w-[220px] sm:border-r sm:border-gray-200 sm:pr-3">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 12z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </span>
                    <select name="state" class="w-full pl-10 pr-10 py-3 sm:py-2.5 border border-gray-200 rounded-xl sm:rounded-r-none sm:rounded-l-xl text-gray-900 font-medium focus:ring-2 focus:ring-pink-500 focus:border-pink-500 bg-gray-50/50 sm:bg-white appearance-none cursor-pointer text-sm">
                        <option value="">Select State / UT</option>
                        <optgroup label="── States">
                        @foreach(config('pelvicare.locations', []) as $loc => $type)
                            @if($type === 'state')
                            <option value="{{ $loc }}" {{ request('state') === $loc ? 'selected' : '' }}>{{ $loc }}</option>
                            @endif
                        @endforeach
                        </optgroup>
                        <optgroup label="── Union Territories">
                        @foreach(config('pelvicare.locations', []) as $loc => $type)
                            @if($type === 'union_territory')
                            <option value="{{ $loc }}" {{ request('state') === $loc ? 'selected' : '' }}>{{ $loc }}</option>
                            @endif
                        @endforeach
                        </optgroup>
                    </select>
                    <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </span>
                </div>
            </div>
            <!-- Category -->
            <div class="flex-1 sm:max-w-[200px] lg:max-w-[220px] sm:border-r sm:border-gray-200 sm:pr-3">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </span>
                    <select name="category" class="w-full pl-10 pr-10 py-3 sm:py-2.5 border border-gray-200 rounded-xl sm:rounded-r-none sm:rounded-l-none text-gray-900 font-medium focus:ring-2 focus:ring-pink-500 focus:border-pink-500 bg-gray-50/50 sm:bg-white appearance-none cursor-pointer text-sm">
                        <option value="">Category</option>
                        @foreach($navCategories ?? [] as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == (string)$cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </span>
                </div>
            </div>
            <!-- Search doctors / specialists -->
            <div class="flex-[2] min-w-0">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search doctors, specialists, or clinic..."
                           class="w-full pl-10 pr-4 py-3 sm:py-2.5 border border-gray-200 rounded-xl sm:rounded-l-none sm:rounded-r-xl focus:ring-2 focus:ring-pink-500 focus:border-pink-500 text-sm placeholder-gray-500">
                </div>
            </div>
            <div class="sm:flex-shrink-0">
                <button type="submit" class="w-full sm:w-auto bg-pink-600 hover:bg-pink-700 text-white font-semibold px-6 py-3 sm:py-2.5 rounded-xl transition-colors text-sm shadow-sm">
                    Search
                </button>
            </div>
        </form>
    </div>
</section>
