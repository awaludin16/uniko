<x-app>
    <x-slot:content>
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Keranjang</h5>
                <h1 class="mb-5">Menu Yang Kamu Pilih</h1>
            </div>
            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="tab-content">
                    <div class="tab-pane fade show p-0 active">
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-4" id="cart-menus">
                                    @foreach ($menus as $menu)
                                        <x-menu :menu="$menu" width="col-12"></x-menu>
                                    @endforeach
                                </div>
                            </div>
                            <form class="card-body" action="{{ url('order') }}" method="POST">
                                @csrf
                                <div class="d-flex justify-content-between gap-2">
                                    <input type="hidden" name="order_menus" id="orderMenus">
                                    <input type="number" name="table_number" id="tableNumber" class="form-control" placeholder="Table Number" min="1" required>
                                    <button type="submit" class="btn btn-primary" id="submitBtn">Order</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:content>
    <x-slot:script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                element("#cart-menus").innerHTML = "";
                
                const cart = getCart()

                element("#orderMenus").value = JSON.stringify(cart)

                cart.forEach(function (menu) {
                    element("#cart-menus").innerHTML += `
                        <div class="col-12">
                            <div class="d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded" src="${menu.image}" alt="" style="width: 80px;">
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <h5 class="d-flex justify-content-between border-bottom pb-2">
                                        <span>${menu.name}</span>
                                        <span class="text-primary">${menu.price}</span>
                                    </h5>
                                    <h5 class="d-flex justify-content-between align-items-center">
                                        <small class="fst-italic" style="font-size:14px !important;font-weight:400 !important">${menu.description}</small>
                                        <div class="d-flex gap-1">
                                            <button class="btn btn-sm btn-primary decreaseBtn" data-id="${menu.id}">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <span class="btn btn-sm btn-outline-secondary quantity">${menu.quantity}</span>
                                            <button class="btn btn-sm btn-primary increaseBtn" data-id="${menu.id}">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    `

                    elements(".increaseBtn").forEach(function (button) {
                        button.addEventListener("click", function () {
                            const menu = cart.find((menu) => menu.id == this.dataset.id)
                            menu.quantity += 1

                            this.previousElementSibling.innerText = menu.quantity

                            saveCart(cart)
                            element("#orderMenus").value = JSON.stringify(cart)
                        })
                    })

                    elements(".decreaseBtn").forEach(function (button) {
                        button.addEventListener("click", function () {
                            const menu = cart.find((menu) => menu.id == this.dataset.id)

                            menu.quantity -= 1
                            this.nextElementSibling.innerText = menu.quantity

                            if(!menu.quantity) {
                                saveCart(cart.filter((menu) => menu.quantity > 0))
                                window.location.reload()
                            } else {
                                saveCart(cart)
                                element("#orderMenus").value = JSON.stringify(cart)
                            }
                        })
                    })
                })
            })
        </script>
    </x-slot:script>
</x-app>
