<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 mx-6 mt-4">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Create New Category Section -->
                <div
                    class="px-6 py-4 bg-gradient-to-r from-blue-500 to-blue-700 text-white flex justify-between items-center">
                    <h3 class="text-xl font-semibold">Manage Categories</h3>
                    <a href="{{ route('adminCategories.create') }}"
                        class="bg-white text-blue-700 font-semibold px-4 py-2 rounded-lg shadow hover:bg-gray-100">
                        + Create New Category
                    </a>
                </div>

                <!-- Category List Section -->
                <div class="px-6 py-4">
                    <h4 class="text-lg font-medium text-gray-800 mb-3">Existing Categories</h4>
                    @if ($categories->isEmpty())
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
                            No categories available. Click the button above to create a new one.
                        </div>
                    @else
                        <table class="min-w-full bg-white border border-gray-200 shadow rounded-lg">
                            <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Name
                                    </th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-6 py-4 text-gray-800 text-sm font-medium">
                                            {{ $category->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex space-x-3">
                                                <a href="{{ route('categories.edit', $category) }}"
                                                    class="text-blue-500 hover:underline font-semibold">
                                                    Edit
                                                </a>
                                                <form action="{{ route('adminCategories.destroy', $category) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-500 hover:underline font-semibold">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
