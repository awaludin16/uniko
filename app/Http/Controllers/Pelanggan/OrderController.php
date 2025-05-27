<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function form()
    {
        // if (!session()->has('cart')) {
        //     return 'Cart not found in session';
        // }

        // if (!session()->has('nomor_meja')) {
        //     return 'Nomor meja not found in session';
        // }

        // dd(session()->all());
        $cart = session('cart', []);
        $nomorMeja = session('nomor_meja');

        if (!$nomorMeja || empty($cart)) {
            return redirect()->route('customer.index')->with('error', 'Keranjang kosong atau nomor meja tidak ditemukan.');
        }

        $menuIds = array_keys($cart);
        $menus = Menu::whereIn('id', $menuIds)->get();

        return view('pelanggan.order', compact('menus', 'cart'));
    }
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'payment_method' => 'required|string|in:Cash,QRIS,Debit'
        ]);

        $cart = session('cart', []);
        $nomorMeja = session('nomor_meja');

        if (!$nomorMeja || empty($cart)) {
            return redirect()->route('customer.index')->with('error', 'Nomor meja atau keranjang tidak ditemukan.');
        }

        $meja = Meja::where('nomor_meja', $nomorMeja)->firstOrFail();

        $order = Order::create([
            'meja_id' => $meja->id,
            'nama_pelanggan' => $request->nama_pelanggan,
            'order_date' => now(),
            'total' => 0, // akan dihitung di bawah
            'status' => 'Pending',
        ]);

        $total = 0;

        foreach ($cart as $menuId => $item) {
            $menu = Menu::query()->findOrFail($menuId);
            $quantity = $item['quantity'];
            $subtotal = $menu->price * $quantity;

            $order->items()->create([
                'order_id' => $order->id,
                'menu_id' => $menu->id,
                'quantity' => $quantity,
                'price' => $menu->price,
            ]);

            $total += $subtotal;
        }

        $order->update(['total' => $total]);

        // Simpan data pembayaran
        $order->payment()->create([
            'order_id' => $order->id,
            'payment_date' => null,
            'method' => $request->payment_method,
            'amount' => $order->total,
            'status' => 'Pending'
        ]);

        // Jika pembayaran non-cash, arahkan ke Xendit
        // if (in_array($request->metode_pembayaran, ['QRIS', 'Debit'])) {
        //     // Inisialisasi Xendit
        //     Xendit::setApiKey(config('services.xendit.secret_key'));

        //     $externalId = 'order-' . $order->id . '-' . Str::uuid();
        //     $params = [
        //         'external_id' => $externalId,
        //         'payer_email' => 'test@example.com', // opsional, sesuaikan
        //         'description' => 'Pembayaran Order #' . $order->id,
        //         'amount' => $total,
        //         'success_redirect_url' => route('payment.success', $order->id),
        //         'failure_redirect_url' => route('payment.failed', $order->id),
        //     ];

        //     $invoice = \Xendit\Invoice::create($params);

        //     // Simpan invoice URL dan external_id
        //     $payment->update([
        //         'payment_url' => $invoice['invoice_url'],
        //         'external_id' => $externalId,
        //     ]);

        //     return redirect($invoice['invoice_url']);
        // }

        session()->forget('cart'); // bersihkan keranjang

        return redirect()->route('order.detail', $order->id)->with('success', 'Pesanan berhasil dibuat.');
    }
    public function showDetail($id)
    {
        $order = Order::with(['items.menu', 'meja', 'payment'])->findOrFail($id);
        $payment = $order->payment;

        return view('pelanggan.detail', compact('order'));
    }
}
