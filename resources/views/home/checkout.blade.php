@extends('app')

@section('content')
    <div class="bg-gray-900 py-16">
        <div class="container mx-auto p4-10">
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
                        <h2 class="text-2xl font-bold text-gray-800">Checkout</h2>
                        <p class="mt-4 text-gray-600">Please fill out the form below to complete your purchase.</p>
                        <form action="{{Route('checkout.store')}}" method="POST">
                            @csrf
                            <div class="mb-6">
                                <label class="block text-gray-800 font-bold mb-2" for="name">
                                    Name*
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="name" id="name" type="text" placeholder="John Doe">
                            </div>
                                <div class="mb-6">
                                    <label class="block text-gray-800 font-bold mb-2" for="card_number" ">
                                        Card Number*
                                    </label>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="card_number" type="text" placeholder="**** **** **** 1234">
                                </div>
                                <div class="mb-6">
                                    <label class="block text-gray-800 font-bold mb-2" for="expiration_date">
                                        Expiration Date*
                                    </label>
                                    <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="expiration_date" placeholder="MM / YY">
                                </div>
                                <div class="mb-6">
                                    <label class="block text-gray-800 font-bold mb-2" for="cvv">
                                        CVV*
                                    </label>
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="cvv" type="number" placeholder="***">
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
