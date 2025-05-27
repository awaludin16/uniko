<x-app>
    <x-slot:content>
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Receipt</h5>
                <h1 class="mb-5">Data Transaksi</h1>
            </div>
            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="tab-content">
                    <div class="tab-pane fade show p-0 active">
                        <form action="/payment" method="POST" class="card">
                            @csrf
                            
                            <div class="card-body">
                                <div class="mb-3 text-start">
                                    <label for="payment_id" class="form-label">ID Pembayaran</label>
                                    <input type="number" class="form-control" id="payment_id" name="payment_id" value="{{ $data->id }}" readonly>
                                </div>
                                <div class="mb-3 text-start">
                                    <label for="order_id" class="form-label">ID Pesanan</label>
                                    <input type="number" class="form-control" id="order_id" name="order_id" value="{{ $data->order_id }}" readonly>
                                </div>
                                <div class="mb-3 text-start">
                                    <label for="order_total" class="form-label">Total Pesanan</label>
                                    <input type="number" class="form-control" id="order_total" name="order_total" value="{{ $data->order->total }}" readonly>
                                </div>
                                <div class="mb-3 text-start">
                                    <label for="payment_method" class="form-label">Metode Pembayaran</label>
                                    <input type="text" class="form-control" id="payment_method" name="payment_method" value="{{ $data->method }}" readonly>
                                </div>
                                <div class="text-start">
                                    <label for="payment_amount" class="form-label">Jumlah Pembayaran</label>
                                    <input type="number" class="form-control" id="payment_amount" name="payment_amount" value="{{ $data->amount }}" readonly>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:content>
</x-app>
