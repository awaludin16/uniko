<x-app-layout>
    <x-slot name="title">Keranjang</x-slot>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
            @if ($order->status == 'Pending')
                <p>Pergi ke kasir dan bayar untuk memperoses pesanan</p>
            @endif
        </div>
    @endif

    <div class="container mx-auto">
        <div class="bg-white shadow-sm">
            <header class="border-b border-slate-200 p-4">
                <h1 class="text-xl font-bold text-slate-800 sm:text-3xl">Petail Pesanan</h1>
            </header>
            <div class="flex items-center px-4 py-2 justify-between">
                <h3 class="text-amber-600 text-lg font-medium">#{{ $order->id }}</h3>
                <span class="text-yellow-500">{{ $order->status }}</span>
            </div>
        </div>

        <div class="m-4 border rounded border-slate-200 bg-white">
            <div class="px-3 py-4">
                <h3 class="text-slate-700 font-medium">Informasi Pesanan</h3>
            </div>
            <div class="text-slate-600 px-3 pb-3">
                <div class="flex justify-between mb-2 items-center">
                    <p>Meja</p>
                    <p class="text-slate-700 font-normal">{{ $order->meja->nomor_meja }}</p>
                </div>
                <div class="flex justify-between mb-2 items-center">
                    <p>Nama pelanggan</p>
                    <p class="text-slate-700 font-normal">{{ $order->nama_pelanggan }}</p>
                </div>
                <div class="flex justify-between mb-2 items-center">
                    <p>Tgl pesanan</p>
                    <p class="text-slate-700 font-normal">{{ $order->order_date }}</p>
                </div>
                <div class="flex justify-between mb-2 items-center">
                    <p>Status pesana</p>
                    <p class="text-slate-700 font-normal">{{ $order->status }}</p>
                </div>
            </div>
        </div>

        <div class="m-4 border rounded border-slate-200 bg-white">
            <div class="px-3 py-4">
                <h3 class="text-slate-700 font-medium">Rincian Menu</h3>
            </div>
            <div class="text-slate-600 px-3 pb-3">
                @foreach ($order->items as $item)
                    {{-- @dd($item) --}}
                    <div class="flex justify-between mb-2 items-center">
                        <p>{{ $item->quantity }} x {{ $item->menu->name }}</p>
                        <p class="text-slate-700 font-normal">{{ $item->price }}</p>
                    </div>
                @endforeach
                <div class="flex justify-end mt-2 items-center">
                    <p class="text-slate-700 font-normal text-lg"><span class="text-base">Total:</span>
                        Rp{{ number_format($order->total, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">

            <p><strong>Nomor Meja:</strong> {{ $order->meja->nomor_meja }}</p>
            <p><strong>Nama Pelanggan:</strong> {{ $order->nama_pelanggan }}</p>
            <p><strong>Tanggal Order:</strong> {{ $order->order_date }}</p>
            <p><strong>Status:</strong> {{ $order->status }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $order->payment->method }}</p>

            <hr class="my-4">

            <h3 class="text-lg font-semibold mb-2">Pesanan:</h3>
            <ul>
                @foreach ($order->items as $item)
                    <li class="mb-1">
                        {{ $item->menu->nama_menu }} - {{ $item->quantity }} x
                        Rp{{ number_format($item->menu->price) }}
                        =
                        <strong>Rp{{ number_format($item->price) }}</strong>
                    </li>
                @endforeach
            </ul>

            <hr class="my-4">
            <p class="text-xl font-bold">Total: Rp{{ number_format($order->total) }}</p>
        </div>
    </div>
</x-app-layout>
