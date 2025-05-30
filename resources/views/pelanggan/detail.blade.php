@php
    use Carbon\Carbon;
@endphp

<x-app-layout>
    <x-slot name="title">Keranjang</x-slot>

    {{-- heading --}}
    <div class="bg-white shadow mx-auto fixed z-50 left-0 right-0 -top-1">
        <div class="flex items-center border-b border-slate-200 p-4">
            <span class="pr-7">
                <i class="ri-arrow-left-line mx-auto text-2xl"></i>
            </span>
            <h1 class="text-xl font-bold text-slate-800 sm:text-3xl">Detail Pesanan</h1>
            <div class="flex justify-end ml-auto items-center">
                <span class="">
                    <i class="ri-customer-service-line my-auto text-2xl"></i>
                </span>
            </div>
        </div>
        <div class="flex items-center px-4 py-2 justify-between">
            <h3 class="text-amber-700 text-lg font-medium">#{{ $order->id }}</h3>
            <span class="text-yellow-500">{{ $order->status }}</span>
        </div>
    </div>

    <div class="mb-4 mt-24 p-4 bg-green-100 font-medium text-base text-green-800 rounded">
        Pesanan berhasil dibuat
        @if ($order->status == 'Pending')
            <p class="font-normal text-lg leading-5 mt-1.5 text-slate-600"><span class="font-medium text-base">
                    [Noted] </span>Harap konfirmasi pembayaran di kasir. Terima kasih</p>
        @endif
    </div>

    <div class="container mx-auto">
        <div class="m-4 border rounded border-slate-200 bg-white">
            <div class="px-3 py-4 flex items-center">
                <span class="pr-3"><i class="ri-file-list-3-line text-xl mx-auto"></i></span>
                <h3 class="text-slate-700 font-medium">Informasi pesanan</h3>
            </div>
            <div class="text-slate-600 px-3 pb-3">
                <div class="flex justify-between mb-2 items-center">
                    <p>Id pesanan</p>
                    <p class="text-slate-700 font-normal">{{ $order->id }}</p>
                </div>
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
                    <p class="text-slate-700 font-normal">
                        {{ Carbon::parse($order->order_date)->translatedFormat('d F Y') }}</p>
                </div>
                <div class="flex justify-between mb-2 items-center">
                    <p>Status pesanan</p>
                    <p class="text-slate-700 font-normal">{{ $order->status }}</p>
                </div>
            </div>
        </div>

        <div class="m-4 border rounded border-slate-200 bg-white">
            <div class="px-3 py-4 flex items-center">
                <span class="pr-3"><i class="ri-list-unordered text-xl mx-auto"></i></span>
                <h3 class="text-slate-700 font-medium">Rincian menu</h3>
            </div>
            <div class="text-slate-600 px-3 pb-3">
                @foreach ($order->items as $item)
                    @php
                        $item->price *= $item->quantity;
                    @endphp
                    <div class="flex justify-between mb-2 items-center">
                        <p>{{ $item->quantity }} x {{ $item->menu->name }}</p>
                        <p class="text-slate-700 font-normal"><span
                                class="text-sm">Rp</span>{{ number_format($item->price, 0, ',', '.') }}</p>
                    </div>
                @endforeach
                <div class="flex justify-end mt-2 items-center">
                    <p class="text-slate-700 font-normal text-lg"><span class="text-base">Total:
                            Rp</span>{{ number_format($order->total, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="m-4 border rounded border-slate-200 bg-white">
            <div class="px-3 py-4 flex items-center">
                <span class="pr-3"><i class="ri-bank-card-2-line text-xl mx-auto"></i></span>
                <h3 class="text-slate-700 font-medium">Info pembayaran</h3>
                <div class="flex justify-end ml-auto items-center">
                    <p class="text-yellow-500">{{ $order->payment->status }}</p>
                </div>
            </div>
            <div class="text-slate-600 px-3 pb-3">
                <div class="flex justify-between mb-2 items-center">
                    <p>Total bayar</p>
                    <p class="text-slate-700 font-normal"><span
                            class="text-sm">Rp</span>{{ number_format($order->payment->amount, 0, ',', '.') }}</p>
                </div>
                <div class="flex justify-between mb-2 items-center">
                    <p>Metode pembayaran</p>
                    <p class="text-slate-700 font-normal">{{ $order->payment->method }}</p>
                </div>
                <div class="flex justify-between mb-2 items-center">
                    <p>Waktu transaksi</p>
                    <p class="text-slate-700 font-normal">
                        {{ optional($order->payment)->payment_date ? Carbon::parse($order->payment->payment_date)->translatedFormat('d F Y H:i') : 'Null' }}
                        {{ $order->payment->paymen_date }}</p>
                </div>
                <div class="flex justify-between mb-2 items-center">
                    <p>Status</p>
                    <p class="text-slate-700 font-normal">{{ $order->payment->status }}</p>
                </div>
                <div class="flex justify-between mb-2 items-center">
                    <p>Atas nama</p>
                    <p class="text-slate-700 font-normal">
                        {{ $order->nama_pelanggan }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
