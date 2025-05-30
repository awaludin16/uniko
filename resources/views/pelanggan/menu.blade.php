<x-app-layout>
    <x-slot name="title">Menu</x-slot>

    <style>
        *,
        *:before,
        *:after {
            box-sizing: border-box;
        }

        .sendtocart::before {
            animation: yAxis 1s alternate forwards cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .sendtocart.cart-item {
            display: block;
            animation: xAxis 1s forwards cubic-bezier(1, 0.44, 0.84, 0.165);
        }

        .cart::before {
            content: attr(data-totalitems);
            font-size: 12px;
            font-weight: 600;
            position: absolute;
            top: -2px;
            right: 18px;
            background-color: #973c00;
            line-height: 24px;
            padding: 0 5px;
            height: 24px;
            min-width: 24px;
            color: white;
            text-align: center;
            border-radius: 24px;
        }

        .cart.shake {
            animation: shakeCart 0.4s ease-in-out forwards;
        }

        @keyframes xAxis {
            100% {
                transform: translateX(calc(50vw - 105px));
            }
        }

        @keyframes yAxis {
            100% {
                transform: translateY(calc(-50vh + 75px));
            }
        }

        @keyframes shakeCart {
            25% {
                transform: translateX(6px);
            }

            50% {
                transform: translateX(-4px);
            }

            75% {
                transform: translateX(2px);
            }

            100% {
                transform: translateX(0);
            }
        }
    </style>

    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    {{-- heading --}}
    <div class="bg-white px-2 pt-2 shadow-sm mx-auto fixed z-50 left-0 right-0 -top-1">
        <form class="flex items-center relative">
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative w-full mr-4">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="simple-search"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search" required>
            </div>
            <a href="{{ route('cart.index') }}" id="cart" data-totalitems="{{ $cartCount }}"
                class="{{ $cartCount ? 'cart' : '' }} "
                class="text-slate-700 mx-4 font-medium rounded-lg hover:text-slate-500 cursor-pointer"><i
                    class="ri-shopping-cart-2-line my-auto text-3xl"></i></a>
        </form>
        @php
            $activeCategory = request()->get('highlight'); // Untuk highlight awal dari query string
        @endphp

        <div class="flex justify-around text-center text-slate-700 sticky top-[70px] bg-white z-50">
            @foreach ($categories as $cat)
                <a href="#section-{{ strtolower($cat->name_category) }}"
                    class="grow py-3 transition duration-300 hover:bg-gray-50 category-link {{ strtolower($activeCategory) == strtolower($cat->name_category) ? 'text-amber-500 font-normal border-b-2 border-amber-500' : '' }}"
                    data-category="{{ strtolower($cat->name_category) }}">
                    {{ ucfirst($cat->name_category) }}
                </a>
            @endforeach
        </div>
    </div>

    <div
        class="bg-amber-100 mt-28 font-normal text-center scroll-mt-28 text-slate-700 p-2.5 rounded-lg border mx-2 border-slate-200">
        <p class="text-base">Nomor meja: {{ $meja->nomor_meja }}</p>
    </div>

    <!-- card -->
    <div id="all" class="container mt-4 mb-6 flex flex-col gap-8 px-2 scroll-mt-28">
        @foreach ($menusByCategory as $categoryName => $menus)
            <div id="section-{{ strtolower($categoryName) }}" class="scroll-mt-28 mb-2.5"
                data-category="{{ strtolower($categoryName) }}">
                <h2 class="text-lg font-medium text-slate-700 mb-2 capitalize">{{ $categoryName }}</h2>
                <div class="grid grid-cols-2 gap-2">
                    @foreach ($menus as $menu)
                        {{-- Card menu --}}
                        <div id="menu-{{ $menu->id }}"
                            class="bg-white relative shadow-lg hover:shadow-xl transition duration-500 rounded-lg">
                            <div class="aspect-[4/3] w-full overflow-hidden rounded-t-lg">
                                <img class="object-cover w-full h-full rounded-t-lg"
                                    src="{{ asset('storage/menu-images/' . $menu->image) }}" alt="" />
                            </div>
                            <div class="py-1 px-1 rounded-lg bg-white">
                                <h1 class="text-slate-700 font-medium mb-1 hover:text-gray-900 hover:cursor-pointer">
                                    {{ $menu->name }}</h1>
                                <p class="text-xs text-slate-500 leading-3">{{ $menu->description }}</p>
                                <div class="mb-1 mr-1 mt-4 flex justify-between">
                                    <div class="font-medium text-lg my-auto text-amber-400"><span
                                            class="text-xs">Rp</span>{{ number_format($menu->price, 0, ',', '.') }}
                                    </div>
                                    <button onclick="addToCart({{ $menu->id }})"
                                        class="addtocart flex justify-center items-center w-10 h-10 bg-amber-500 text-white rounded-full shadow-md hover:shadow-lg transition duration-300 hover:bg-amber-600">
                                        <span class="cart-item"></span>
                                        <i class="ri-shopping-cart-2-line text-xl"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryLinks = document.querySelectorAll('.category-link');
            const sections = document.querySelectorAll('[data-category]');

            // Scroll ke section
            categoryLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').replace('#', '');
                    const section = document.getElementById(targetId);

                    if (section) {
                        section.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Update highlight active link
            function setActiveCategory(category) {
                categoryLinks.forEach(link => {
                    link.classList.remove('text-amber-500', 'font-bold', 'border-b-2', 'border-amber-500');
                    if ((category === "" && link.getAttribute('href') === '#all') ||
                        link.dataset.category === category) {
                        link.classList.add('text-amber-500', 'font-bold', 'border-b-2', 'border-amber-500');
                    }
                });
            }

            const observer = new IntersectionObserver((entries) => {
                for (const entry of entries) {
                    if (entry.isIntersecting) {
                        const currentCategory = entry.target.dataset.category;
                        setActiveCategory(currentCategory);
                        break;
                    }
                }
            }, {
                rootMargin: "-30% 0px -60% 0px",
                threshold: 0.1
            });

            sections.forEach(section => observer.observe(section));
        });


        function addToCart(menuId) {
            fetch(`/cart/add/${menuId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const button = document.querySelector(`#menu-${menuId} .addtocart`);
                        const cart = document.getElementById('cart');
                        let cartTotal = parseInt(cart.dataset.totalitems);
                        let newCartTotal = cartTotal + 1;

                        console.log(data);

                        // Tambahkan animasi
                        button.classList.add('sendtocart');
                        setTimeout(() => {
                            button.classList.remove('sendtocart');
                            cart.classList.add('cart')
                            cart.classList.add('shake');
                            cart.setAttribute('data-totalitems', newCartTotal);
                            setTimeout(() => {
                                cart.classList.remove('shake');
                            }, 500);
                        }, 300);
                    }
                });
        }
    </script>
    <script src="//unpkg.com/alpinejs" defer></script>
</x-app-layout>
