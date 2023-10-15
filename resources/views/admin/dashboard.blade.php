@extends('admin.app')

@section('content')
    <div class="container mx-auto mt-4">
        <div class="grid md:grid-cols-3 grid-cols-1 mt-6">
            @foreach($dashboardResults as $key => $result)
                <div class="mr-6 mb-6 bg-black shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="flex p-4">
                        <div class="w-2/3 px-1">
                            <p class="mb-2 font-sans  font-semibold leading-normal text-md whitespace-nowrap text-blue-600">
                                {{ strtoupper($key) }}
                            </p>
                            <h1 class="font-bold text-2xl text-white">{{ $result }}</h1>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('script')
@endsection
