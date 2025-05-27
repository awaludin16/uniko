<x-app>
    <x-slot:content>
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Payment</h5>
                <h1 class="mb-5">Silahkan lakukan pembayaran</h1>
            </div>
            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="tab-content">
                    <div class="tab-pane fade show p-0 active">
                        <form action="/payment" method="POST" class="card">
                            @csrf
                            
                            <div class="card-body">
                                <div class="mb-3 text-start">
                                    <label for="order_id" class="form-label">ID Pesanan</label>
                                    <input type="number" class="form-control" id="order_id" name="order_id" value="{{ $order->id }}" readonly>
                                </div>
                    
                                <div class="mb-3 text-start">
                                    <label for="method" class="form-label">Metode Pembayaran</label>
                                    <select class="form-select" id="method" name="method" required>
                                        <option value="" disabled selected>Pilih metode pembayaran</option>
                                        <option value="QRIS" {{ old('method') == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                                        <option value="Cash" {{ old('method') == 'Cash' ? 'selected' : '' }}>Cash</option>
                                        <option value="Debit" {{ old('method') == 'Debit' ? 'selected' : '' }}>Debit</option>
                                    </select>
                                </div>
                    
                                <div class="mb-3 text-start">
                                    <label for="amount" class="form-label">Jumlah Pembayaran</label>
                                    <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" required>
                                </div>
                    
                                <button type="submit" class="btn btn-primary w-100">Payment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:content>
    <x-slot:script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                saveCart([])
            })
        </script>
    </x-slot:script>
</x-app>
