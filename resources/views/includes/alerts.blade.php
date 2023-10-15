@if (Session::has('success'))
    <div class="flex min-h-full flex-col justify-center px-6 py-2 lg:px-8">
        <div class="mt-2 sm:mx-auto sm:w-full sm:max-w-sm">
            <div class="font-medium text-green-600">
                {{Session::get('success')}}
            </div>
        </div>
    </div>
@endif
@if (Session::has('error'))
    <div class="flex min-h-full flex-col justify-center px-6 py-2 lg:px-8">
        <div class="mt-2 sm:mx-auto sm:w-full sm:max-w-sm">
            <div class="font-medium text-red-600">
                {{Session::get('error')}}
            </div>
        </div>
    </div>
@endif
