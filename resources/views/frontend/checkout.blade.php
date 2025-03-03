<x-frontend-layout>
    <section>
        <div class="container py-10">
            <h1>Checkout</h1>

            <div class="grid grid-cols-3 mt-5 items-center gap-10">
                <div class="col-span-2">
                    <form action="{{ route('order.store') }}" method="post" class="space-y-5">
                        @csrf
                        <input type="text" name="total_amount" value="{{$total}}" hidden>
                        <input type="text" name="shop_id" value="{{$id}}" hidden>
                        <div>
                            <label for="payment_type">Preferred Payment Method</label>
                            <select name="payment_type" id="payment_type" class="w-full">
                                <option value="cod">Cash on Delivery</option>
                            </select>
                        </div>

                        <div>
                            <button class="btn-primary">Order</button>
                        </div>
                    </form>
                </div>

                <div class="border rounded-md px-4 py-5 bg-slate-200">
                    <h2>Order Description</h2>
                    <ul>
                        @foreach ($carts as $cart)
                            <li>
                                {{ $cart->product->name }}
                            </li>
                        @endforeach
                    </ul>

                    <div>
                        Total : NRs.{{ number_format($total, 2) }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-frontend-layout>
