<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Dashboard - Manage Content
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-10">

                <!-- Posts Section -->
                <div class="space-y-6">
                    <div class="flex justify-between items-center">
                        <h3 class="text-2xl font-semibold text-gray-900">Manage Posts</h3>
                        <a href="{{ route('posts.create') }}"
                            class="inline-block px-5 py-2 bg-green-500 text-black font-semibold rounded-md shadow-md hover:bg-green-400 focus:outline-none transition duration-200">
                            + Create New Post
                        </a>
                    </div>
                    <table class="min-w-full bg-white border">
                        <thead>
                            <tr class="text-left bg-gray-100">
                                <th class="py-2 px-4">Title</th>
                                <th class="py-2 px-4">Status</th>
                                <th class="py-2 px-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr class="border-b">
                                    <td class="py-2 px-4">{{ $post->title }}</td>
                                    <td class="py-2 px-4">{{ $post->status }}</td>
                                    <td class="py-2 px-4 text-center">
                                        <a href="{{ route('posts.edit', $post) }}"
                                            class="text-blue-600 hover:underline">Edit</a>
                                        <form action="{{ route('posts.destroy', $post) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:underline ml-4">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Categories Section -->
                <div class="space-y-6">
                    <div class="flex justify-between items-center mt-2">
                        <h3 class="text-2xl font-semibold text-gray-900">Manage Categories</h3>
                        <a href="{{ route('categories.create') }}"
                            class="inline-block px-5 py-2 bg-blue-500 text-black font-semibold rounded-md shadow-md hover:bg-blue-400 focus:outline-none transition duration-200">
                            + Create New Category
                        </a>
                    </div>
                    <table class="min-w-full bg-white border">
                        <thead>
                            <tr class="text-left bg-gray-100">
                                <th class="py-2 px-4">Category Name</th>
                                <th class="py-2 px-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr class="border-b">
                                    <td class="py-2 px-4">{{ $category->name }}</td>
                                    <td class="py-2 px-4 text-center flex">
                                        <a href="{{ route('categories.edit', $category) }}"
                                            class="text-blue-600 hover:underline px-2">Edit</a>
                                        <form action="{{ route('adminCategories.destroy', $category) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:underline ml-4">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
