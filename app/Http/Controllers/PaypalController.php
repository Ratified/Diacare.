<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Payment;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
    public function payment(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        // Calculate total price from the cart
        $cartItems = Cart::where('user_id', auth()->id())->get();
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.success'),
                "cancel_url" => route('paypal.cancel')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => number_format($totalPrice, 2, '.', '')
                    ]
                ]
            ]
        ]);

        // Redirect to the approval URL
        if (isset($response['id']) && isset($response['links'][1]['href'])) {
            return redirect($response['links'][1]['href']);
        } else {
            return redirect()->route('paypal.cancel');
        }
    }

    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $purchaseUnits = $response['purchase_units'][0] ?? null;
            $amount = $purchaseUnits['amount']['value'] ?? null;
            $currency = $purchaseUnits['amount']['currency_code'] ?? null;

            if ($amount && $currency) {
                // Store the payment details
                Payment::create([
                    'user_id' => auth()->id(),
                    'payment_id' => $response['id'],
                    'payer_id' => $response['payer']['payer_id'],
                    'amount' => $amount,
                    'currency' => $currency,
                    'status' => $response['status'],
                ]);

                // Clear the user's cart
                Cart::where('user_id', auth()->id())->delete();

                return redirect()->route('cart.index')->with('success', 'Payment successful!');
            } else {
                return redirect()->route('cart.index')->with('error', 'Payment details are missing!');
            }
        } elseif (isset($response['error']['name']) && $response['error']['name'] == 'UNPROCESSABLE_ENTITY' && isset($response['error']['details'][0]['issue']) && $response['error']['details'][0]['issue'] == 'ORDER_ALREADY_CAPTURED') {
            // Handle the case where the order is already captured
            return redirect()->route('cart.index')->with('error', 'Order has already been captured.');
        } else {
            return redirect()->route('cart.index')->with('error', 'Payment failed!');
        }
    }



    public function cancel()
    {
        // Handle payment cancellation
        return redirect()->route('cart.index')->with('error', 'Payment was cancelled!');
    }
}