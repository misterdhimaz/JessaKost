<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handleMayar(Request $request)
    {
        Log::info("Mayar Webhook received: ", $request->all());

        $event = $request->input('event', '');
        $data = $request->input('data', []);
        $status = strtolower($data['status'] ?? '');

        // Terima berbagai macam format event sukses dari Mayar
        $isSuccessEvent = in_array($event, ['payment.success', 'payment.received', 'invoice.paid']) || in_array($status, ['paid', 'success', 'settled']);

        if ($isSuccessEvent) {
            // Check if extraData exists in data or nested inside invoice
            $extraData = $data['extraData'] ?? $data['invoice']['extraData'] ?? null;
            $billId = $extraData['billId'] ?? null;

            if ($billId) {
                $bill = Bill::find($billId);
                if ($bill) {
                    $bill->update(['status' => 'paid', 'paid_at' => now()]);
                    Log::info("Bill {$billId} updated to paid via Mayar Webhook");
                }
            }
        }

        return response()->json(['message' => 'OK'], 200);
    }
}
