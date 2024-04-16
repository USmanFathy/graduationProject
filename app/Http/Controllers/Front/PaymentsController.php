<?php

namespace App\Http\Controllers\Front;

use App\Events\DownloadPdfAfterPaymentSuccess;
use App\Events\PaymentSuccess;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
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
                'clientSecret' => $paymentIntent->client_secret
            ];
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Handle exception
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function confirm(Request $request, Order $order)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $paymentIntent =$stripe->paymentIntents->retrieve($request->query('payment_intent'), []);
        if($paymentIntent->status == 'succeeded'){
            $firstIteration = true;
            $user =auth()->user();
            $items = $order->items();
            foreach ($items as $item){
                if ($item->product->type == 'pdf'){
                    $product = $item->product;
                    event(new DownloadPdfAfterPaymentSuccess($user ,$product));
                }
                else if ($firstIteration){
                    event(new PaymentSuccess($user));
                    $firstIteration = false;
                }
                }
            $payment = new Payment();
            $payment->forceFill([
                'order_id' => $order->id,
                'amount'=>$paymentIntent->amount,
                'currency' => $paymentIntent->currency,
                'method' => 'stripe',
                'status'  => 'completed',
                'transaction_id' => $paymentIntent->id,
                'transaction_data'=> json_encode($paymentIntent),

                                ])->save();

        }
        return Payment::all();
    }
}
