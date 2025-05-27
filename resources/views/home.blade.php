<x-app>
    <x-slot:content>
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Menu</h5>
                <h1 class="mb-5">Menu Yang Tersedia</h1>
            </div>
            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="tab-content">
                    <div class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            @foreach ($menus as $menu)
                                <x-menu :menu="$menu" width="col-lg-6"></x-menu>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:content>
    <x-slot:script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const cart = getCart()

                elements(".addBtn").forEach(function (button) {
                    button.addEventListener("click", function () {
                        if(!cart.length) {
                            cart.push({
                                id: this.dataset.id,
                                name: this.dataset.name,
                                price: this.dataset.price,
                                description: this.dataset.description,
                                image: this.dataset.image,
                                quantity: 1
                            })

                        } else {
                            const existingMenu = cart.find((menu) => menu.id == this.dataset.id)

                            if(existingMenu) {
                                existingMenu.quantity += 1
                            } else {
                                cart.push({
                                    id: this.dataset.id,
                                    name: this.dataset.name,
                                    price: this.dataset.price,
                                    description: this.dataset.description,
                                    image: this.dataset.image,
                                    quantity: 1
                                })
                            }
                        }

                        saveCart(cart)
                        alert("Menu berhasil ditambahkan ke keranjang!")
                    })
                })
            })
        </script>
    </x-slot:script>
</x-app>
