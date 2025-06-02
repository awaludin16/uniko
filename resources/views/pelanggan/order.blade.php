<x-app-layout>
    <x-slot name="title">Order</x-slot>

    <div class="bg-white shadow-sm mx-auto fixed z-50 left-0 right-0 -top-1">
        <div class="flex items-center">
            <a href="{{ route('cart.index') }}" class="pr-3 px-4">
                <i class="ri-arrow-left-line my-auto text-2xl"></i>
            </a>
            <header class="p-4">
                <h1 class="text-xl font-bold text-slate-800 sm:text-3xl">Checkout</h1>
            </header>
        </div>
    </div>
    </div>

    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="mt-18 container mx-auto">
        <div class="mb-4 bg-white">
            <div class="py-3 mb-2 border-b border-slate-200">
                <h1 class="block text-base font-medium px-4 text-slate-800" for="nama_pelanggan">Menu yang dipesan
                </h1>
            </div>
            @php $total = 0; @endphp
            @foreach ($menus as $menu)
                @php
                    $qty = $cart[$menu->id]['quantity'];
                    $subtotal = $menu->price * $qty;
                    $total += $subtotal;
                @endphp
                <div class="flex gap-4 px-4 py-2 items-center text-slate-800">
                    <div
                        class="flex aspect-square items-center justify-center w-1/6 h-1/w-1/6 overflow-hidden rounded-lg bg-gray-100">
                        <img class="object-cover object-center w-full h-full"
                            src="{{ asset('storage/menu-images/' . $menu->image) }}" alt="">
                    </div>
                    <div class="my-1.5 text-slate-600 w-full">
                        <div class="flex items-center justify-between mb-1">
                            <h4 class="">{{ $menu->name }}</h4>
                            <p class="text-sm">x {{ $qty }}</p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-sm">{{ $menu->price }} / item</p>
                            <p class="text-sm">{{ $subtotal }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- form --}}
        <form method="POST" action="{{ route('order') }}">
            @csrf

            {{-- nama pelanggan input --}}
            <div class="mb-4 bg-white">
                <div class="py-3 border-b border-slate-200">
                    <label class="block text-base font-medium px-4 text-slate-800" for="nama_pelanggan">Nama
                        pelanggan</label>
                </div>
                <div class="p-4">
                    <input id="nama_pelanggan" name="nama_pelanggan"
                        class="border bg-slate-50 border-slate-300 rounded-lg focus:ring transition py-2.5 px-4 block w-full text-base text-slate-700 placeholder:text-sm placeholder:text-slate-400 focus:outline-1 focus:outline focus:outline-slate-400"
                        placeholder="Masukan nama" type="text" value="{{ old('nama_pelanggan') }}" />
                    @error('nama_pelanggan')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- payments method --}}
            <div class="flex flex-col bg-white mb-32">
                <div class="py-3 border-b border-slate-200">
                    <h1 class="text-base font-medium px-4 text-slate-800">Pilih metode pembayaran</h1>
                </div>
                @error('payment_method')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
                <div class="flex flex-col gap-3 px-4">
                    <label for="cash" class="flex justify-between items-center">
                        <div class="flex flex-row-reverse items-center">
                            <div class="ml-6 py-4 text-slate-700">
                                <h3 class="font-medium">Cash</h3>
                                <p class="text-sm text-slate-500 mb-1">Bayar di Kasir</p>
                            </div>
                            <img alt="Money Special Flat icon" loading="lazy" decoding="async" data-nimg="1"
                                class="_e0usu51 size-14"
                                src="https://cdn-icons-png.freepik.com/512/998/998662.png?uid=R151018612&amp;ga=GA1.1.178936179.1717067031"
                                style="color: transparent;">
                        </div>
                        <input id="cash" type="radio" name="payment_method" value="Cash" class="size-4"
                            required>
                    </label>
                    <label for="qris" class="flex justify-between items-center">
                        <div class="flex flex-row-reverse items-center">
                            <div class="ml-6 py-4 text-slate-700">
                                <h3 class="font-medium">Pembayaran Online</h3>
                                <p class="text-sm text-slate-500 mb-1">QRIS/E-Wallet/MBanking/dll</p>
                            </div>
                            <img alt="Online payment Flaticons Flat icon" loading="lazy" decoding="async" data-nimg="1"
                                class="_e0usu51 size-14" style="color:transparent"
                                src="https://cdn-icons-png.freepik.com/512/10551/10551890.png?uid=R151018612&amp;ga=GA1.1.178936179.1717067031">
                        </div>
                        <input id="qris" type="radio" name="payment_method" value="Pembayaran Online"
                            class="size-4" required>
                    </label>
                </div>
            </div>

            <div
                class="fixed left-0 right-0 bottom-0 flex justify-between items-center border-t bg-white p-4 border-gray-100">
                <p class="inline-block text-base font-normal text-slate-800">
                    Total:
                    <span class="block text-2xl text-center font-bold text-amber-600" id="total-display"> Rp
                        {{ number_format($total, 0, ',', '.') }}</span>
                </p>
                <div class="flex justify-end items-center">
                    <button type="submit"
                        class="block rounded-lg bg-amber-500 px-5 py-3 font-medium text-gray-100 transition hover:bg-amber-600 hover:shadow-lg">
                        Buat pesanan
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
