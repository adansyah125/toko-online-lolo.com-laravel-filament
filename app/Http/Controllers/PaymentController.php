<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Activity;
use Midtrans\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function bayar(Request $request, $order_id)
    {
        $order = Order::where('order_id', $order_id)->firstOrFail();

        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION') === 'true';
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $transaction_details = [
            'order_id' => $order->order_id,
            'gross_amount' => $order->total_harga,
        ];

        $customer_details = [
            'first_name' => $order->nama_penerima,
            'email' => auth()->user()->email,
            'phone' => $order->no_telp,
        ];

        $params = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            // Simpan Payment sebagai pending
            Payment::updateOrCreate(

                [
                    'user_id' => auth()->id(),
                    'jasa_id' => $order->id,
                    'order_id' => $order->order_id,
                    'price' => $order->total_harga,
                    'payment_status' => 'gagal',
                    'order_status' => 'proses',
                    'payment_id' => $snapToken,
                ]
            );

            Activity::create([
                'user_id' => Auth::id(),
                'activity' => 'Payment',
                'deskripsi' => "Melakukan pembayaran untuk pesanan {$order->order_id}",
                'created_at' => Carbon::now('Asia/Jakarta'),
            ]);

            return response()->json([
                'order_id' => $order->order_id,
                'snapToken' => $snapToken
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }




    public function callback(Request $request)
    {
        $notif = new Notification();

        $order_id = $notif->order_id;
        $status = $notif->transaction_status;

        $payment = Payment::where('order_id', $order_id)->first();
        $order = Order::where('order_id', $order_id)->first();

        if (!$payment || !$order) return;

        if ($status == 'capture' || $status == 'settlement') {
            $payment->update(['payment_status' => 'berhasil']);
            $order->update(['status' => 'paid']);
        } elseif ($status == 'cancel' || $status == 'expire' || $status == 'deny') {
            $payment->update(['payment_status' => 'gagal']);
            $order->update(['status' => 'failed']);
        }
    }


    public function markAsLunas($order_id)
    {
        $payment = Payment::where('order_id', $order_id)->firstOrFail();
        $payment->update(['payment_status' => 'berhasil']);

        $order = Order::where('order_id', $order_id)->first();
        if ($order) $order->update(['status' => 'paid']);

        return response()->json(['message' => 'Status diperbarui menjadi lunas']);
    }
}
