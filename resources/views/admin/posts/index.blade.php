<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mb-4 flex justify-end">
            <form method="GET" action="{{ route('posts.index') }}" class="flex space-x-4">
                <!-- Search Input -->
                <input type="text" name="search" placeholder="Search posts..." value="{{ request('search') }}"
                    class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 px-4 py-2">

                <!-- Category Dropdown -->
                <select name="category_id"
                    class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 px-4 py-2 mr-2">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Submit Button -->
                <button type="submit"
                    class="rounded-md bg-blue-500 px-4 py-2 hover:bg-blue-600 transition duration-200 text-black">
                    Filter
                </button>
            </form>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg p-6">
                @if (auth()->check() && auth()->user()->role_id == 1)
                    <div class="mb-6 text-right">
                        <a href="{{ route('posts.create') }}"
                            class="rounded-md bg-slate-800 py-2 px-4 border border-transparent text-center text-sm text-black  transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">
                            <i class="fas fa-plus-circle mr-2"></i> Create New Post
                        </a>
                    </div>
                @endif

                @if ($posts->isEmpty())
                    <div class="bg-yellow-100 p-4 rounded-lg">
                        <p class="text-yellow-800 font-semibold">No posts available. Start by creating a new post.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($posts as $post)
                            <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                                <h3 class="text-xl font-semibold text-gray-800">{{ $post->title }}</h3>
                                <p class="text-gray-600 mt-2">{{ $post->status }}</p>

                                @if (auth()->check() && auth()->user()->role_id == 1)
                                    <div class="mt-4 flex space-x-4">
                                        <a href="{{ route('posts.edit', $post) }}"
                                            class="text-blue-600 hover:text-blue-800 flex items-center mx-2">
                                            <i class="fas fa-edit mx-2"></i> Edit
                                        </a>
                                        <form action="{{ route('posts.destroy', $post) }}" method="POST"
                                            class="flex items-center">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-800 flex items-center"
                                                onclick="return confirm('Are you sure you want to delete this post?');">
                                                <i class="fas fa-trash-alt mr-2"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

{{ $posts->appends(request()->except('page'))->links() }}
