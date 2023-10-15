<nav class="p-3 bg-black shadow md:flex md:items-center md:justify-between text-gray-400">
    <div class="container mx-auto px-8 md:justify-between inline-flex">
    <div class="mt-2 flex justify-between items-center">
        <span class="text-2xl font-[Poppins] cursor-pointer">
            <a  href="{{ route('home') }}">
                <img src="{{ asset('images\logo.png') }}" class="h-12 inline rounded-lg">
            </a>
        </span>
        <span class="text-3xl text-right cursor-pointer mx-2 md:hidden block">
            <ion-icon name="menu" onclick="menu(this)"></ion-icon>
        </span>
    </div>
    @if (Route::has('login'))
        <ul class="md:flex md:items-center z-[-1]
        md:z-auto md:static absolute
        w-full left-0 md:w-auto md:py-0 py-6
        md:pl-0 pl-7 md:opacity-100 opacity-0 text-gray-400
        transition-all ease-in duration-500 bg-black" style="top: 0px!important;">
            <li class="mx-2 my-4 md:my-0">
                <a href="{{Route('home')}}" class="text-lg hover:text-cyan-500 duration-500"> Home</a>
            </li>
            @auth
                @if(auth()->user()->role == 'admin')
                    <li class="mx-2 my-4 md:my-0 md:pl-4">
                        <a href="{{ url('/admin/dashboard') }}" class="text-lg hover:text-cyan-500 duration-500">Dashboard</a>
                    </li>
                @endif
                <li class="mx-2 my-4 md:my-0 md:pl-4">
                    <form action="{{Route('logout')}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-lg hover:text-cyan-500 duration-500">Log Out</button>
                    </form>
                </li>
            @else
                <li class="mx-2 my-4 md:my-0 md:pl-4">
                    <a href="{{ route('login.create') }}" class="text-lg hover:text-cyan-500 duration-500">Log in</a>
                </li>
                <li class="mx-2 my-4 md:my-0">
                    <a href="{{ route('register.create') }}" class="text-lg hover:text-cyan-500 duration-500">Register</a>
                </li>
            @endauth
            <!-- Cart -->
            <li class="mx-2 my-4 md:my-0">
                <a href="{{Route('orders')}}" class="group -m-2 flex items-center p-2" data-tooltip-target="tooltip-default">
                    <svg class="h-10 w-10 flex-shrink-0 text-gray-400 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    <span class="ml-2 text-lg font-strong text-gray-700 group-hover:text-gray-800">
                        @if(Session::has('cart'))
                            <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                {{sizeof(Session::get('cart'))}}
                            </span>
                        @endif
                    </span>
                    <span class="sr-only">items in cart, view bag</span>
                </a>
                <div id="tooltip-default" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    View Orders
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </li>
        </ul>
    @endif
    </div>
</nav>

<script>
    function menu(e){
        if( e.name === 'menu'){
            document.getElementById('sidebar').style.marginTop = "150px";
        }else{
            document.getElementById('sidebar').style.marginTop = "0px";
        }
        let list = document.querySelector('ul');
        e.name === 'menu'
            ? (e.name = "close",list.classList.add('top-[800px]'), list.classList.add('opacity-100'))
            :(e.name = 'menu', list.classList.remove('top-[800px]'), list.classList.remove('opacity-100'))
    }
</script>
