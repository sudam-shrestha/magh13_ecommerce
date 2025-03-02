<nav class="bg-primary">
    <div class="container flex items-center justify-between py-4">
        <a href="{{ route('home') }}">
            <img class="h-[40px]" src="https://codeit.com.np/storage/01JJ6HWH8RP35HYNCEBFXVYZKF.png" alt="Floor">
        </a>
        <form action="{{ route('compare') }}" method="get">
            <div class="flex">
                <input class="w-full bg-white py-2 px-4" type="text" name="q" id="q">
                <button class="bg-gray-300 primary font-semibold px-2">Compare</button>
            </div>
        </form>
        <div class="flex gap-4 items-center">
            @if (!Auth::user())
                <a href="{{ route('register') }}" class="btn-primary">SignUp</a>
                <a href="{{ route('login') }}" class="btn-secondary">Login</a>
            @else
                <a href="{{route('carts')}}" class="text-white relative">
                    <i class="fa-solid fa-cart-shopping text-2xl"></i>
                    <span class="absolute -top-2 -right-2 rounded bg-red-600 h-4 w-4 text-[10px] flex items-center justify-center">
                        {{Auth::user()->carts->count()}}
                    </span>
                </a>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="bg-red-600 px-3 py-1 rounded-md text-white">Logout</button>
                </form>
            @endif
        </div>
    </div>
</nav>
