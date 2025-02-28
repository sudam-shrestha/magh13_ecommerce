<nav class="bg-primary">
    <div class="container flex items-center justify-between py-4">
        <a href="{{route('home')}}">
            <img class="h-[40px]" src="https://codeit.com.np/storage/01JJ6HWH8RP35HYNCEBFXVYZKF.png" alt="Floor">
        </a>
        <form action="{{ route('compare') }}" method="get">
            <div class="flex">
                <input class="w-full bg-white py-2 px-4" type="text" name="q" id="q">
                <button class="bg-gray-300 primary font-semibold px-2">Compare</button>
            </div>
        </form>
        <div>
            <a href="{{route('register')}}" class="btn-primary">SignUp</a>
            <a href="{{route('login')}}" class="btn-secondary">Login</a>
        </div>
    </div>
</nav>
