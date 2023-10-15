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
                        @if($product->image)
                            <img class="object-cover w-70 h-45" style="min-height: 160px" src="{{asset('storage/images/'.$product->id.'-'.$product->image)}}" alt="image.jpg">
                        @else
                            <img class="object-cover w-70 h-45" style="min-height: 160px" src="{{asset('images\logo.png')}}" alt="image.jpg">
                        @endif
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
                            @php $color = 'bg-gray-900';@endphp
                            @php $qnt = 0 ;@endphp
                            @if($carts = Session::has('cart'))
                                @if(isset(session('cart')[$product->id]))
                                    @php $color = 'bg-green-600' @endphp
                                    @php $qnt = session('cart')[$product->id]['quantity'] @endphp
                                @endif
                            @endif
                            <button type="submit" class="{{$color}} text-white py-1 px-2 rounded-full font-bold hover:bg-gray-800">
                                +Add
                                @if($qnt > 0)
                                <span class="bg-red-100 text-red-800 text-xs font-medium mr-1 px-2 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                    {{$qnt}}
                                </span>
                                @endif
                            </button>
                        </form>
                    </div>

                    <div class="flex items-center mt-2 mb-0">
                        @foreach($product->tags as $tag)
                            <span class="text-blue-600 font-bold text-xs mr-1">
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
