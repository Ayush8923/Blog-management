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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <ul>
                    @foreach ($posts as $post)
                        <a href="{{ route('posts.show', $post) }}">
                            <li class="p-6 text-gray-900 flex justify-between">
                                {{ $post->title }}
                                <div>{{ $post->author->name }}</div>
                            </li>
                        </a>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
