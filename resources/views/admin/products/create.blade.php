@extends('admin.app')

@section('content')

    <div class="container mx-auto mt-4">
        <div class="w-full mx-auto mt-4">
            @if ($errors->any())
                <div class="max-w-md mx-auto overflow-hidden md:max-w-xl">
                    <div class="md:flex">
                        <div class="w-full px-6 py-8 md:p-8">
                            <div class="font-medium text-red-600">
                                {{ __('Whoops! Something went wrong.') }}
                            </div>

                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            <div class="mb-1">
                @include('includes.alerts')
            </div>

            <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden md:max-w-xl">
                <div class="md:flex">
                    <div class="w-full px-6 py-8 md:p-8">
                        <h2 class="text-2xl font-bold text-gray-800">New Product</h2>
                        <p class="mt-4 text-gray-600">Please fill out the form below to crate new product.</p>
                        <form action="{{Route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-6">
                                <label class="block text-gray-800 font-bold mb-2" for="name">
                                    Name*
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="name" id="name" required type="text" placeholder="John Doe">
                            </div>

                            <div class="mb-6">
                                <div class="mb-4">
                                    <label for="image" class="block mb-2 text-md font-medium text-gray-900">Upload Image</label>
                                    <input id="image" name="image[]" class="block w-full text-md text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:ring-blue-500 dark:border-gray-300 dark:placeholder-gray-400" type="file">
                                </div>
                            </div>

                            <div class="mb-6">
                                <label class="block text-gray-800 font-bold mb-2" for="name">
                                    Description
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="description" id="description" type="text" placeholder="Product Description ...">
                            </div>
                            <div class="mb-6">
                                <label class="block text-gray-800 font-bold mb-2" for="name">
                                    Brand*
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="brand" id="brand" type="text" placeholder="Product Description ...">
                            </div>
                            <div class="mb-6">
                                <label class="block text-gray-800 font-bold mb-2" for="name">
                                    Model*
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="model" id="model" type="text" placeholder="Product Description ...">
                            </div>
                            <div class="mb-6">
                                <label class="block text-gray-800 font-bold mb-2" for="name">
                                    Registration Date*
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="registration_date" id="registration_date" type="date" placeholder="Product Description ...">
                            </div>
                            <div class="mb-6">
                                <label class="block text-gray-800 font-bold mb-2" for="name">
                                    Engine Size*
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="engine_size" id="engine_size" type="number" placeholder="Product Description ...">
                            </div>
                            <div class="mb-6">
                                <label class="block text-gray-800 font-bold mb-2" for="name">
                                    Price*
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="price" id="price" type="number" placeholder="Product Description ...">
                            </div>
                            <div class="mb-6">
                                <label class="block text-gray-800 font-bold mb-2" for="name">
                                    Active
                                </label>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="active" id="active" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                </label>
                            </div>
                            <div class="mb-6">
                                <label for="tags" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Tags(Multiple)</label>
                                <select multiple id="tags" name="tags[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}"> {{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
