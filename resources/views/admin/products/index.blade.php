@extends('admin.app')

@section('content')
    <div class="container mx-auto mt-4">
        <div class="flex mt-8">
            <a href="{{ route('admin.products.create') }}" class ="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
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
                        <th class="border border-slate-200">Photo</th>
                        <th class="border border-slate-200">Name</th>
                        <th class="border border-slate-200">Description</th>
                        <th class="border border-slate-200">Brand</th>
                        <th class="border border-slate-200">Model</th>
                        <th class="border border-slate-200">Registration Date</th>
                        <th class="border border-slate-200">Engine Size</th>
                        <th class="border border-slate-200">Price</th>
                        <th class="border border-slate-200">Active</th>
                        <th class="border border-slate-200">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($products->count() > 0)
                        @foreach($products as $key=> $product)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="border border-slate-200 p-1" style="min-width: 80px">
                                    <img class="rounded-lg bg-cover bg-center items-center" src="{{asset('storage/images/'.$product->id.'-'.$product->image)}}" alt="">
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    {{$product['name']}}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    {{$product['description']}}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    {{$product['brand']}}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    {{$product['model']}}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    {{$product->registration_date->format('Y-m-d')}}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    {{$product['engine_size']}}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    {{$product['price']}}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" value="" class="sr-only peer" @if($product->active) checked @endif onchange="isActive(this, {{ $product['id'] }})">
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                    </label>
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{Route('admin.products.destroy', $product->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return  confirm('Do you really want to remove product?')" data-tooltip-target="tooltip-delete-default" class="font-medium text-red-600 dark:text-red-500 hover:underline">
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
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function isActive(div, id){
            $.ajax({
                type:'POST',
                url:'{{ route('admin.products.updateStatus') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                },
                async: true,
                dataType: 'JSON',
                success:function(data) {
                    if(data['status'] === 'success'){
                        if(data.active === 1){
                            alert('Product Updated - Active')
                        }else{
                            alert('Product Updated - No_Active')
                        }
                    }
                },
                error: function (error){
                    alert('An Error Has Occurred')
                }
            });
        }
    </script>
@endsection
