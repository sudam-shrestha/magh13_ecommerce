<x-frontend-layout>

    @if (Auth::user())
        <button id="allow-notifications-btn" class="btn btn-custom btn-lg">Allow Notifications</button>
    @endif

    {{-- Featured Shop --}}
    <section>
        <div class="container py-10">
            <div class="mb-5">
                <h1 class="text-3xl font-semibold primary">Featured Restaurant/Store</h1>
                <p>
                    The nearest restaurant/store to your location
                </p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ($shops as $shop)
                    <a href="#" class="shadow-md hover:shadow-xl rounded-md overflow-hidden">
                        <img class="h-[300px] w-full object-cover"
                            src="{{ asset(Storage::url($shop->shop_profile->image)) }}" alt="">
                        <div class="p-4">
                            <h1>
                                {{ $shop->shop_profile->shop_name }}
                            </h1>
                            <p>
                                {{ $shop->shop_profile->address }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    {{-- Featured Shop --}}


    {{-- Special Offer --}}
    <section>
        <div class="container py-10">
            <div class="mb-5">
                <h1 class="text-3xl font-semibold primary">Special Deals</h1>
                <p>
                    Best quality deals & products
                </p>
            </div>


            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach ($special_deals as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </div>
    </section>
    {{-- Special Offer --}}

    {{-- Shop Request --}}
    <section>
        <div class="container py-20">
            <div class="text-center">
                <h1 class="text-3xl">
                    List your Restaurant or Store at Floor Digital Pvt. Ltd.! <br>
                    Reach 1,00,000 + new customers.
                </h1>

                <button class="btn-primary mt-5 cursor-pointer" data-modal-target="request-modal"
                    data-modal-toggle="request-modal">
                    Send A Request
                </button>
            </div>

            <!-- Main modal -->
            <div id="request-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow-sm">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                            <h3 class="text-xl font-semibold primary">
                                Welcome to Floor Digital Pvt. Ltd.
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                data-modal-hide="default-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5 space-y-4">
                            <form action="{{ route('shop_request') }}" method="post">
                                @csrf
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="name">Your Name <span class="text-red-600">*</span></label>
                                        <input type="text" name="name" id="name"
                                            class="w-full rounded-md border border-slate-500 py-2 px-4" required
                                            placeholder="Enter your name">
                                    </div>

                                    <div>
                                        <label for="shop_name">Shop/Resturant Name <span
                                                class="text-red-600">*</span></label>
                                        <input type="text" name="shop_name" id="shop_name"
                                            class="w-full rounded-md border border-slate-500 py-2 px-4" required
                                            placeholder="Enter Shop/Resturant name ">
                                    </div>

                                    <div>
                                        <label for="contact">Mobile <span class="text-red-600">*</span></label>
                                        <input type="tel" name="contact" id="contact"
                                            class="w-full rounded-md border border-slate-500 py-2 px-4" required
                                            placeholder="Enter mobile number ">
                                    </div>

                                    <div>
                                        <label for="email">Email <span class="text-red-600">*</span></label>
                                        <input type="email" name="email" id="email"
                                            class="w-full rounded-md border border-slate-500 py-2 px-4" required
                                            placeholder="Enter mobile number ">
                                    </div>

                                    <div class="col-span-2">
                                        <label for="address">Address Detail <span class="text-red-600">*</span></label>
                                        <input type="text" name="address" id="address"
                                            class="w-full rounded-md border border-slate-500 py-2 px-4" required
                                            placeholder="Enter shop address">
                                    </div>

                                    <div class="text-center col-span-2">
                                        <button type="submit" class="btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    {{-- Shop Request --}}



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        const firebaseConfig = {
            apiKey: "AIzaSyCDoxz4_eCpnRexb6QddGZdI4bLfTJZPN0",
            authDomain: "magh13.firebaseapp.com",
            projectId: "magh13",
            storageBucket: "magh13.firebasestorage.app",
            messagingSenderId: "122828337174",
            appId: "1:122828337174:web:3b9cd6fa243325852d4537",
            measurementId: "G-5HLPJTHC2J"
        };

        firebase.initializeApp(firebaseConfig);

        const messaging = firebase.messaging();
        messaging.onMessage(function(payload) {
            console.log('Message received in foreground: ', payload);
            const title = payload.notification.title;
            const options = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            // Show notification in the foreground
            new Notification(title, options);
        });

        // Handle Allow Notifications button
        document.getElementById('allow-notifications-btn').addEventListener('click', () => {
            messaging.requestPermission()
                .then(() => messaging.getToken())
                .then((token) => {
                    console.log('FCM Token:', token);

                    // Send token to the server
                    fetch('/save-token', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                        },
                        body: JSON.stringify({
                            token: token
                        }),
                    }).then(response => {
                        if (response.ok) {
                            alert('Notifications enabled successfully!');
                        } else {
                            alert('Failed to save token.');
                        }
                    });
                })
                .catch((error) => {
                    console.error('Permission denied:', error);
                    alert('Failed to enable notifications.');
                });
        });
    </script>


</x-frontend-layout>
