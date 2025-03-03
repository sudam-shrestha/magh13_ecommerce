<x-frontend-layout>
    <section>
        <div class="container py-10 px-4 sm:px-6 lg:px-8">
            <div class="mb-5">
                <h1 class="text-3xl font-semibold text-gray-800">Shopping Cart</h1>
            </div>

            @if ($carts->isEmpty())
                <div class="text-center py-10">
                    <p class="text-gray-500 text-lg">Your cart is empty</p>
                    <a href="{{ route('home') }}"
                        class="mt-4 inline-block px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Continue Shopping
                    </a>
                </div>
            @else
                <!-- Group carts by shop -->
                @foreach ($carts->groupBy('product.shop.id') as $shopId => $shopCarts)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
                        <!-- Shop Header -->
                        <div class="p-4 bg-gray-50 border-b">
                            <h2 class="text-xl font-medium text-gray-800">
                                Shop: {{ $shopCarts->first()->product->shop->name }}
                            </h2>
                        </div>

                        <!-- Cart Items -->
                        <div class="divide-y divide-gray-200">
                            @foreach ($shopCarts as $cart)
                                <div class="p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                    <!-- Product Info -->
                                    <div class="flex items-center gap-4 flex-1">
                                        <div class="w-20 h-20 bg-gray-100 rounded-md overflow-hidden">
                                            <img src="{{ asset(Storage::url($cart->product->images[0])) }}"
                                                alt="{{ $cart->product->name }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-medium text-gray-900">{{ $cart->product->name }}
                                            </h3>
                                            <p class="text-sm text-gray-600">
                                                Unit Price: NRs{{ number_format($cart->amount, 2) }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Quantity Controls -->
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center border rounded-md">
                                            <button class="px-3 py-1 text-gray-600 hover:bg-gray-100"
                                                onclick="updateQty({{ $cart->id }}, {{ $cart->qty - 1 }})">
                                                -
                                            </button>
                                            <input type="number" class="w-16 text-center border-x-0 focus:ring-0"
                                                value="{{ $cart->qty }}" readonly>
                                            <button class="px-3 py-1 text-gray-600 hover:bg-gray-100"
                                                onclick="updateQty({{ $cart->id }}, {{ $cart->qty + 1 }})">
                                                +
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Subtotal and Remove -->
                                    <div class="flex items-center gap-6">
                                        <p class="text-lg font-semibold text-gray-900">
                                            NRs{{ number_format($cart->amount * $cart->qty, 2) }}
                                        </p>
                                        {{-- <form action="{{ route('cart.remove', $cart->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="text-red-600 hover:text-red-800">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form> --}}

                                        <button class="text-red-600 hover:text-red-800 remove-cart-btn"
                                            data-cart-id="{{ $cart->id }}">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>

                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Shop Summary and Checkout -->
                        <div class="p-6 border-t bg-gray-50">
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-gray-600">Shop Total</span>
                                <span class="text-xl font-semibold text-gray-900">
                                    NRs{{ number_format($shopCarts->sum(fn($cart) => $cart->amount * $cart->qty), 2) }}
                                </span>
                            </div>
                            <div class="flex justify-end">
                                <a href="{{ route('check_out', $shopCarts->first()->product->shop_id) }}"
                                    class="btn-primary">
                                    Proceed to Checkout
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function updateQty(cartId, qty) {
            if (qty < 1) return;
            fetch('/cart/update/' + cartId, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        qty: qty
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
        }


        document.querySelectorAll('.remove-cart-btn').forEach(button => {
            button.addEventListener('click', function() {
                const cartId = this.getAttribute('data-cart-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to remove this item from your cart?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch("{{ url('/cart/remove') }}/" + cartId, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    location.reload();
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        data.message || 'Something went wrong.',
                                        'error'
                                    );
                                }
                            })
                            .catch(error => {
                                Swal.fire(
                                    'Error!',
                                    'Failed to remove item.',
                                    'error'
                                );
                            });
                    }
                });
            });
        });
    </script>

</x-frontend-layout>
