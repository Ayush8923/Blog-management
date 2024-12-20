<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Edit Post' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('posts.update', $post) }}" method="POST" class="space-y-6 p-6">
                    @csrf
                    @method('PUT')

                    <!-- Title Field -->
                    <div class="flex flex-col">
                        <label for="title" class="text-gray-700 font-medium">Post Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                            class="border-gray-300 rounded-md p-2 mt-1" placeholder="Enter the title of your post">
                        @error('title')
                            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Content Field -->
                    <div class="flex flex-col">
                        <label for="content" class="text-gray-700 font-medium">Post Content</label>
                        <textarea name="content" id="content" rows="5" class="border-gray-300 rounded-md p-2 mt-1"
                            placeholder="Write the content of your post here">{{ old('content', $post->content) }}</textarea>
                        @error('content')
                            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Category Dropdown -->
                    <div class="flex flex-col">
                        <label for="category_id" class="text-gray-700 font-medium">Select Category</label>
                        <select name="category_id" id="category_id" class="border-gray-300 rounded-md p-2 mt-1">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Status Dropdown -->
                    <div class="flex flex-col">
                        <label for="status" class="text-gray-700 font-medium">Select Status</label>
                        <select name="status" id="status" class="border-gray-300 rounded-md p-2 mt-1">
                            <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>
                                Draft</option>
                            <option value="published"
                                {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                        @error('status')
                            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="rounded-md bg-slate-800 py-2 px-4 text-black hover:bg-slate-700 transition">
                            Update Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
