<x-frontend-layout>
    <section>
        <div class="container py-10">
            <div class="mb-5">
                <h1 class="text-3xl font-semibold primary">Result for {{ $q }}</h1>
            </div>


            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach ($products as $product)
                  <x-product-card :product="$product" />
                @endforeach
            </div>
        </div>
    </section>
</x-frontend-layout>
