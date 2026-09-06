<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handleMidtrans(Request $request)
    {
        $orderId = $request->input('order_id');
        $status = $request->input('transaction_status');

        Log::info("Webhook received for order: {$orderId}, status: {$status}");

        if ($status === 'settlement' || $status === 'capture') {
            // Mock: order_id format is bill_id_TIMESTAMP
            $billId = explode('_', $orderId)[0] ?? null;
            if ($billId) {
                Bill::where('id', $billId)->update(['status' => 'paid']);
            }
        }

        return response()->json(['message' => 'OK']);
    }
}
