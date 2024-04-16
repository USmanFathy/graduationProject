<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Stripe\StripeClient;

class PaymentsController extends Controller
{
    public function index(Order $order): View {
        return view('front.payments.index', compact('order'));
    }

    public function test(Order $order)
    {
        $total = $order->items->sum(function ($item){
            return $item->price * $item->quantity;
        });
        dd($total);
    }

    use Stripe\StripeClient;

    public function createStripePaymentIntent(Order $order)
    {
        $total = $order->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        // Convert total to cents if it's in dollars
        $totalCents = $total * 100;

        try {
            $stripe = new StripeClient(env('STRIPE_SECRET'));
            $paymentIntent = $stripe->paymentIntents->create([
                                                                 'amount' => $totalCents,
                                                                 'currency' => 'usd',
                                                                 'automatic_payment_methods' => ['enabled' => true],
                                                             ]);

            return [
                'client_secret' => $paymentIntent->client_secret
            ];
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Handle exception
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function confirm(Request $request, Order $order)
    {
        dd($request->all());
    }
}
