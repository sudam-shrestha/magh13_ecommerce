@props(['product'])
<a href="{{ route('product', $product->id) }}" class="grid grid-cols-2 gap-2 items-center">
    <img src="{{ asset(Storage::url($product->images[0])) }}" alt="{{ $product->name }}">

    <div>
        <h1>{{ $product->name }}</h1>
        <div>
            @if ($product->discount && $product->discount > 0)
                <span class="line-through text-red-600">NRs{{ $product->price }}</span>
                {{ $product->price - ($product->discount * $product->price) / 100 }}
            @else
                {{ $product->price }}
            @endif
        </div>
    </div>
</a>
