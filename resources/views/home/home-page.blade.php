@extends('app')

@section('content')
    <div class="bg-gray-900 py-16">
        <div class="container mx-auto">
            <div class="mb-1">
                @include('includes.alerts')
            </div>
            @include('includes.search')
            <h2 class="text-3xl font-bold text-white mb-8 text-center">Introducing Our Cars</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-3 md:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow-lg p-4">
                    <div class="relative overflow-hidden">
                        <img class="object-cover w-70 h-45" src="https://images.unsplash.com/photo-1542291026-7eec264c27ff" alt="Product">
                        <div class="absolute inset-0 bg-black opacity-40"></div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mt-2">
                        {{$product->name}}
                    </h3>
                    <p class="text-gray-500 text-sm mt-2">{{$product->description}}</p>
                    <div class="mt-2">
                        <span class="text-gray-900 font-bold text-md">
                          <i class="fa fa-wpforms"></i> {{$product->brand}}
                        </span>
                    </div>
                    <div class="mt-0">
                        <span class="text-gray-900 font-bold text-md mr-4">
                          <i class="fa fa-car"></i> {{$product->model}}
                        </span>
                        <span class="text-gray-900 font-bold text-md ">
                           <i class="fa fa-caret-up"></i> {{$product->engine_size}}
                        </span>
                    </div>
                    <div class="flex mt-0 justify-content-between">
                        <span class="text-gray-900 font-bold text-md">
                            <i class="fa fa-calendar"></i>
                            {{$product->registration_date->format('Y-m-d')}}
                        </span>
                    </div>
                    <div class="flex items-center justify-between mt-2">
                        <span class="text-gray-900 font-bold text-lg">
                            <i class="fa fa-money"></i> {{$product->price}}
                        </span>
                        <form action="{{Route('products.addToCart', $product->id)}}" method="POST">
                            @csrf
                            <button type="submit" class="bg-gray-900 text-white py-2 px-4 rounded-full font-bold hover:bg-gray-800">Add to Cart</button>
                        </form>
                    </div>

                    <div class="flex items-center mt-2 mb-0">
                        @foreach($product->tags as $tag)
                            <span class="text-blue-600 font-bold text-lg mr-1">
                                #{{$tag->name}}
                            </span>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-2">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
