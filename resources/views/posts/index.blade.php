<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Blog Posts') }}
            </h2>
            @if (auth()->check() && auth()->user()->role_id == 1)
                <div>
                    <a href="{{ route('posts.create') }}"
                        class="rounded-md bg-slate-800 py-2 px-4 border border-transparent text-center text-sm text-black  transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">Create
                        New Post</a>
                    <a href="{{ route('adminCategories.create') }}"
                        class="rounded-md bg-slate-800 py-2 px-4 border border-transparent text-center text-sm text-black transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">Create
                        New Categories</a>
                </div>
            @endif
        </div>
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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if ($posts->isEmpty())
                    <div class="bg-yellow-100 p-4 rounded-lg">
                        <p class="text-yellow-800 font-semibold">No posts available. Start by creating a new post.</p>
                    </div>
                @else
                    <ul>
                        @foreach ($posts as $post)
                            <li class="p-6 text-gray-900 flex justify-between">
                                <div>{{ $post->title }}</div>
                                <div>{{ $post->content }}</div>
                                <div>{{ $post->category->name }}</div>
                                <div>{{ $post->author->name }}</div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
