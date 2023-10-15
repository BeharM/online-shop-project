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
                        <h2 class="text-2xl font-bold text-gray-800">Add Tags</h2>
                        <p class="mt-4 text-gray-600">Please fill out the form below to crate new tags.</p>
                        <form action="{{Route('admin.tags.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-6">
                                <label class="block text-gray-800 font-bold mb-2" for="name">
                                    Name*
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="name" id="name" required type="text" placeholder="John Doe">
                            </div>

                            <div class="mb-6">
                                <label class="block text-gray-800 font-bold mb-2" for="name">
                                    Description
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="description" id="description" type="text" placeholder="Tag Description ...">
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
