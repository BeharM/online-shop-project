@extends('app')

@section('content')

    <div class="relative overflow-x-auto sm:rounded-lg mt-8">
        <div class="container mx-auto">
            <div class="mb-2">
                @include('includes.alerts')
            </div>
            <div class="md:grid md:grid-cols-4 md:grid-flow-col gap-4">
                <div class="col-span-4 md:col-span-3">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Image</span>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Model
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Qty
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $total = 0; @endphp
                    @foreach($orders as $key=> $order)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-32 p-4">
                            <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff" alt="Apple Watch">
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                           {{$order['name']}}
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                            {{$order['model']}}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div>
                                    <input type="number" id="quantity" value="{{$order['quantity']}}" min="1" class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1" required>
                                </div>
                                <button type="button" data-id="{{$key}}" id="update-cart-id" data-tooltip-target="tooltip-refresh-default" class="ml-4 font-medium text-green-600 dark:text-green-500 hover:underline">
                                    <i class="fa fa-refresh"> </i> Update
                                </button>
                                <div id="tooltip-refresh-default" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    Save Quantity Changes
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                            {{$order['quantity']*$order['price']}}
                            @php $total += $order['quantity']*$order['price']; @endphp
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{Route('cart.remove', $key)}}" method="POST">
                                @csrf
                                @method('DELETE')
                            <button type="submit" onclick="return  confirm('Do you really want to remove order from cat?')" data-tooltip-target="tooltip-delete-default" class="font-medium text-red-600 dark:text-red-500 hover:underline">
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
                    </tbody>
                </table>
                    <div class="mt-4 mb-4">
                        {{ $orders->links() }}
                    </div>
                </div>
                <div class="col-span-4 md:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-lg font-semibold mb-4">Summary</h2>
                        <hr class="my-2">
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Total</span>
                            <span class="font-semibold">${{$total}}</span>
                        </div>
                        <a href="{{Route('checkout')}}" class="bg-blue-500 text-white py-2 px-4 rounded-lg mt-4 w-full block text-center">
                            <i class="fa fa-money"></i> Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('home.scripts.update-cart')
@endsection
