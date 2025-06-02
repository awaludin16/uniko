<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;

class PaymentController extends Controller
{

    var $apiInstance = null;

    public function __construct()
    {
        Configuration::setXenditKey(config('services.xendit.secret_key'));
        $this->apiInstance = new InvoiceApi();
    }

    public function payWithXendit(Order $order)
    {
        if ($order->payment && $order->payment->status === 'Paid') {
            return redirect()->route('order.detail', $order->id)
                ->with('info', 'Pesanan ini sudah dibayar.');
        }

        if ($order->payment && $order->payment->status === 'Pending') {
            return redirect($order->payment->checkout_url);
        }

        $external_id = 'order-' . $order->id . '-' . time();

        $create_invoice_request = new CreateInvoiceRequest([
            'external_id' => $external_id,
            'payer_email' => 'test@xendit.co', // bisa diganti
            'description' => 'Pembayaran Order #' . $order->id,
            'amount' => $order->total,
            'success_redirect_url' => route('order.detail', $order->id),
            'failure_redirect_url' => route('order.detail', $order->id),
        ]);

        $invoice = $this->apiInstance->createInvoice($create_invoice_request);

        if ($invoice['available_qr_codes'][0]['qr_code_type'] === 'QRIS') {
            // dd($invoice);
            $paymentMethod = $invoice['available_qr_codes'][0]['qr_code_type'];
        }

        $order->payment()->create([
            'method' => $paymentMethod,
            'amount' => $order->total,
            'status' => 'Pending',
            'payment_date' => null,
            'external_id' => $external_id,
            'checkout_url' => $invoice['invoice_url'],
        ]);

        return redirect($invoice['invoice_url']);
        // return response()->json($invoice);
    }
    public function handleCallback(Request $request)
    {
        // Opsional: simpan log callback (untuk debugging)
        Log::info('Xendit Callback Received', $request->all());

        $externalId = $request->input('external_id');
        $status = $request->input('status');

        if (!$externalId || !$status) {
            return response()->json(['message' => 'Invalid payload'], 400);
        }

        // Cari pembayaran berdasarkan external_id
        $payment = Payment::where('external_id', $externalId)->first();

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        // Update data pembayaran
        $payment->update([
            'status' => $status === 'PAID' ? 'Paid' : $status,
            'payment_date' => now(),
        ]);

        // Opsional: update status pesanan jika dibutuhkan
        if ($status === 'PAID') {
            $payment->order->update(['status' => 'Process']);
        }

        return response()->json(['message' => 'Callback processed'], 200);
    }
}
