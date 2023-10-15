@extends('admin.app')

@section('content')
    <div class="container mx-auto mt-4">
        <div class="flex mt-8">
            <a href="{{ route('admin.tags.create') }}" class ="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                {{ __('+ Add New') }}
            </a>
        </div>
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

        <div class="w-full mx-auto mt-4">
            <div id='recipients' class="p-8 mt-6 lg:mt-0 overflow-x-auto">
                <table id="tableNew" class="stripe hover pb-6 pt-2" style="width: 100%;">
                    <thead>
                    <tr>
                        <th class="border border-slate-200">Name</th>
                        <th class="border border-slate-200">Description</th>
                        <th class="border border-slate-200">Created At</th>
                        <th class="border border-slate-200">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($tags->count() > 0)
                        @foreach($tags as $key=> $tag)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    {{$tag['name']}}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    {{$tag['description']}}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    {{$tag->created_at->format('Y-m-d')}}
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{Route('admin.tags.destroy', $tag->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return  confirm('Do you really want to remove tag?')" data-tooltip-target="tooltip-delete-default" class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                            <i class="fa fa-trash fa-2x"></i>
                                        </button>
                                        <div id="tooltip-delete-default" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                            Remove Order
                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class=" text-center">
                                <span class="text-red-600 text-lg">No Data Found!!!</span>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <div class="mt-4 mb-4">
                    {{ $tags->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
