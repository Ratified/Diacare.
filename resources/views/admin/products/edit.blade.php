<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Product: ') }} {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="mb-4">
                            <label for="productImage" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Product Image</label>
                            <input type="file" name="productImage" id="productImage" class="block w-full mt-1 border-gray-300 dark:border-gray-700 rounded-md shadow-sm text-black">
                            @error('productImage')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Name</label>
                            <input type="text" name="name" id="name" value="{{ $product->name }}" class="block w-full mt-1 border-gray-300 dark:border-gray-700 rounded-md shadow-sm text-black">
                            @error('name')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="price" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Price</label>
                            <input type="number" name="price" id="price" value="{{ $product->price }}" class="block w-full mt-1 border-gray-300 dark:border-gray-700 rounded-md shadow-sm text-black">
                            @error('price')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="category" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Category</label>
                            <input type="text" name="category" id="category" value="{{ $product->category }}" class="block w-full mt-1 border-gray-300 dark:border-gray-700 rounded-md shadow-sm text-black">
                            @error('category')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Description</label>
                            <textarea name="description" id="description" class="block w-full mt-1 border-gray-300 dark:border-gray-700 rounded-md shadow-sm text-black">{{ $product->description }}</textarea>
                            @error('description')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-md shadow-sm hover:bg-blue-500">Update Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
