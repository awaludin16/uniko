<x-app-layout>
    <x-slot name="title">Order</x-slot>

    <div class="bg-white shadow-sm mx-auto fixed z-50 left-0 right-0 -top-1">
        <div class="flex items-center">
            <span class="pr-3 px-4">
                <i class="ri-arrow-left-line my-auto text-2xl"></i>
            </span>
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
                            <svg class="size-14" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1"
                                viewBox="0 0 122.88 71.26">
                                <defs>
                                    <style>
                                        .cls-1 {
                                            fill: #427d2a;
                                        }

                                        .cls-1,
                                        .cls-2 {
                                            fill-rule: evenodd;
                                        }

                                        .cls-2 {
                                            fill: #87cc71;
                                        }

                                        .cls-3 {
                                            fill: #fff;
                                        }
                                    </style>
                                </defs>
                                <title>cash</title>
                                <path class="cls-1"
                                    d="M13.37,0H122.88V60.77l-7.74,0,.54-44.59,0-.53a7.14,7.14,0,0,0-7.13-7.14l-95.2,0V0ZM0,14.42H109.51V71.26H0V14.42Z" />
                                <path class="cls-2"
                                    d="M91.72,23.25a8.28,8.28,0,0,0,8,8.11V53.85a8.51,8.51,0,0,0-8.5,8.71H18.42a8.38,8.38,0,0,0-8.06-8.5V31.57a8.43,8.43,0,0,0,8.52-8.32Z" />
                                <path class="cls-1"
                                    d="M40.28,35.18a16.76,16.76,0,1,1,6.91,22.67,16.75,16.75,0,0,1-6.91-22.67Z" />
                                <path class="cls-3"
                                    d="M55.22,55.38a1.54,1.54,0,0,1-1.56-1.56V52.3A11.09,11.09,0,0,1,51,51.82,13.32,13.32,0,0,1,49.06,51a1.61,1.61,0,0,1-.9-1,2,2,0,0,1,.06-1.27,1.66,1.66,0,0,1,.83-.88,1.57,1.57,0,0,1,1.38.12,10.45,10.45,0,0,0,1.73.69,9.31,9.31,0,0,0,2.72.35,4.27,4.27,0,0,0,2.53-.57A1.73,1.73,0,0,0,58.16,47a1.49,1.49,0,0,0-.52-1.16,4.11,4.11,0,0,0-1.86-.75l-2.84-.62q-4.71-1-4.71-5a5.07,5.07,0,0,1,1.48-3.68,6.84,6.84,0,0,1,3.95-1.88V32.29a1.53,1.53,0,0,1,.44-1.1,1.52,1.52,0,0,1,1.12-.45,1.44,1.44,0,0,1,1.08.45,1.53,1.53,0,0,1,.44,1.1v1.55a10.83,10.83,0,0,1,2,.46,7.18,7.18,0,0,1,1.8.88,1.62,1.62,0,0,1,.76,1,1.75,1.75,0,0,1-.12,1.15,1.43,1.43,0,0,1-.84.76,1.76,1.76,0,0,1-1.41-.19,8.26,8.26,0,0,0-1.52-.57,7.57,7.57,0,0,0-2-.23,3.88,3.88,0,0,0-2.35.62,1.89,1.89,0,0,0-.85,1.6,1.48,1.48,0,0,0,.5,1.15,4.11,4.11,0,0,0,1.77.74l2.87.62a7,7,0,0,1,3.64,1.77,4.36,4.36,0,0,1,1.17,3.14,4.79,4.79,0,0,1-1.48,3.62,7.28,7.28,0,0,1-3.87,1.84v1.62a1.52,1.52,0,0,1-.44,1.1,1.45,1.45,0,0,1-1.08.46Z" />
                            </svg>
                        </div>
                        <input id="cash" type="radio" name="payment_method" value="Cash" class="size-4"
                            required>
                    </label>
                    <label for="qris" class="flex justify-between items-center">
                        <div class="flex flex-row-reverse items-center">
                            <div class="ml-6 py-4 text-slate-700">
                                <h3 class="font-medium">Qris</h3>
                                <p class="text-sm text-slate-500 mb-1">Pembayaran Qris</p>
                            </div>
                            <svg class="size-14" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1"
                                viewBox="0 0 950 950">
                                <defs>
                                    <style>
                                        .cls-1 {
                                            fill: #010101;
                                            stroke-width: 0px;
                                        }
                                    </style>
                                </defs>
                                <polygon class="cls-1"
                                    points="866.23 510.51 866.23 483.45 866.23 429.34 785.06 429.34 730.95 429.34 730.95 402.29 866.23 402.29 866.23 348.18 730.95 348.18 649.78 348.18 649.78 402.29 649.78 429.34 649.78 483.45 730.95 483.45 785.06 483.45 785.06 510.51 649.78 510.51 649.78 564.62 785.06 564.62 866.23 564.62 866.23 510.51" />
                                <rect class="cls-1" x="568.61" y="348.18" width="54.11" height="216.45" />
                                <polygon class="cls-1"
                                    points="325.11 348.18 325.11 402.29 487.44 402.29 487.44 429.34 379.22 429.34 325.11 429.34 325.11 483.45 325.11 564.62 379.22 564.62 379.22 484.27 460.39 564.62 541.56 564.62 456.87 483.45 487.44 483.45 541.56 483.45 541.56 429.34 541.56 402.29 541.56 348.18 487.44 348.18 325.11 348.18" />
                                <path class="cls-1"
                                    d="M162.77,483.45h54.11v-54.11h-54.11v54.11ZM176.3,442.87h27.05v27.06h-27.05v-27.06Z" />
                                <path class="cls-1"
                                    d="M135.72,348.18h-47.35c-1.79,0-3.51.71-4.78,1.98-1.27,1.27-1.98,2.99-1.98,4.78v202.92c0,1.79.71,3.51,1.98,4.78,1.27,1.27,2.99,1.98,4.78,1.98h128.51v-54.11h-81.17v-162.33Z" />
                                <path class="cls-1"
                                    d="M291.29,348.18h-128.51v54.11h81.17v81.17h54.11v-128.52c0-1.79-.71-3.51-1.98-4.78-1.27-1.27-2.99-1.98-4.78-1.98Z" />
                                <rect class="cls-1" x="243.94" y="510.51" width="54.11" height="121.75" />
                                <path class="cls-1"
                                    d="M157.09,317.74H55.63c-1.79,0-3.51.71-4.78,1.98-1.27,1.27-1.98,2.99-1.98,4.78v101.46h13.53v-87.93c0-1.79.71-3.51,1.98-4.78,1.27-1.27,2.99-1.98,4.78-1.98h87.93v-13.53Z" />
                                <path class="cls-1"
                                    d="M887.6,493.6v87.93c0,1.79-.71,3.51-1.98,4.78-1.27,1.27-2.99,1.98-4.78,1.98h-87.93v13.53h101.46c1.79,0,3.51-.71,4.78-1.98,1.27-1.27,1.98-2.99,1.98-4.78v-101.46h-13.53Z" />
                            </svg>
                        </div>
                        <input id="qris" type="radio" name="payment_method" value="QRIS" class="size-4"
                            required>
                    </label>
                    <label for="debit" class="flex justify-between items-center">
                        <div class="flex flex-row-reverse items-center">
                            <div class="ml-6 py-4 text-slate-700">
                                <h3 class="font-medium">Debit</h3>
                                <p class="text-sm text-slate-500 mb-1">Gesek Kartu</p>
                            </div>
                            <svg class="size-14" xmlns="http://www.w3.org/2000/svg"
                                shape-rendering="geometricPrecision" text-rendering="geometricPrecision"
                                image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd"
                                viewBox="0 0 512 385.414">
                                <path fill="#3B95D9" fill-rule="nonzero"
                                    d="M26.217 0h382.258c14.366 0 26.16 11.803 26.16 26.158V264.76c0 14.364-11.796 26.16-26.16 26.16H26.217c-14.384 0-26.16-11.776-26.16-26.16V26.158C.057 11.798 11.859 0 26.217 0z" />
                                <path fill="#42A6F1"
                                    d="M26.216 7.674h382.26c10.166 0 18.484 8.356 18.484 18.484v238.603c0 10.128-8.356 18.483-18.484 18.483H26.216c-10.128 0-18.483-8.317-18.483-18.483V26.158c0-10.166 8.317-18.484 18.483-18.484z" />
                                <path fill="#4D5471" d="M0 56.192h434.691v74.811H0z" />
                                <path fill="#D54C3D" fill-rule="nonzero"
                                    d="M103.585 94.494H485.84c7.197 0 13.737 2.948 18.471 7.682l.47.515c4.467 4.71 7.219 11.051 7.219 17.961v238.602c0 14.364-11.796 26.16-26.16 26.16H103.585c-14.383 0-26.16-11.777-26.16-26.16V120.652c0-7.167 2.939-13.697 7.679-18.449l.049-.048c4.749-4.728 11.273-7.661 18.432-7.661z" />
                                <path fill="#ED5444"
                                    d="M103.585 102.168H485.84c10.167 0 18.484 8.356 18.484 18.484v238.602c0 10.128-8.356 18.484-18.484 18.484H103.585c-10.128 0-18.484-8.317-18.484-18.484V120.652c0-10.167 8.317-18.484 18.484-18.484z" />
                                <path fill="#F8D14A" fill-rule="nonzero"
                                    d="M126.406 283.827a8.33 8.33 0 110-16.661h167.77a8.33 8.33 0 010 16.661h-167.77zm242.263-26.394c12.433 0 23.464 5.995 30.363 15.254 6.9-9.259 17.932-15.254 30.367-15.254 20.9 0 37.845 16.944 37.845 37.844 0 20.902-16.945 37.846-37.845 37.846-12.435 0-23.467-5.997-30.367-15.256-6.899 9.259-17.93 15.256-30.363 15.256-20.903 0-37.846-16.944-37.846-37.846 0-20.9 16.943-37.844 37.846-37.844zm-242.263 65.959a8.331 8.331 0 010-16.661h126.509a8.332 8.332 0 010 16.661H126.406z" />
                                <path fill="#DACD71"
                                    d="M139.602 153.639h56.914c7.258 0 13.197 5.939 13.197 13.197v2.883h-83.307v-2.883c0-7.258 5.938-13.197 13.196-13.197zm70.111 20.621v28.134h-25.844V174.26h25.844zm-30.384 28.134h-22.568V174.26h22.568v28.134zm-27.109 0h-25.814V174.26h25.814v28.134zm57.493 4.541v2.928c0 7.257-5.94 13.196-13.197 13.196h-56.914c-7.257 0-13.196-5.938-13.196-13.196v-2.928h83.307z" />
                            </svg>
                        </div>
                        <input id="debit" type="radio" name="payment_method" value="Debit" class="size-4"
                            required>
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
