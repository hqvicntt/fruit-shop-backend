<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BankTransaction;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    // Endpoint for SePay to send bank balance notifications
    public function handleSepayWebhook(Request $request)
    {
        // SePay sends 'transferAmount' and 'content' in JSON payload
        $amount = $request->input('transferAmount', 0);
        $content = $request->input('content', '');
        $transferType = $request->input('transferType', '');

        // Only record incoming money transfers ('in')
        if ($transferType === 'in' && $amount > 0) {
            BankTransaction::create([
                'amount_in' => $amount,
                'transaction_content' => $content,
            ]);
        }

        // Always return 200 OK with success: true as required by SePay
        return response()->json(['success' => true], 200);
    }

    // 2. Endpoint for Flutter App to check if a specific order code has been paid
    public function checkPaymentStatus(Request $request)
    {
        $orderCode = $request->query('code');
        $expectedAmount = (int) $request->query('amount');

        if (!$orderCode) {
            return response()->json(['paid' => false]);
        }

        // Search for a transaction containing the orderCode and matching amount
        $transaction = BankTransaction::where('transaction_content', 'LIKE', "%{$orderCode}%")
            ->where('amount_in', '>=', $expectedAmount)
            ->first();

        if ($transaction) {
            return response()->json([
                'paid' => true,
                'amount_in' => $transaction->amount_in,
            ]);
        }

        return response()->json(['paid' => false]);
    }
}
