<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
use Stripe;

class StripeController extends Controller
{
    public function payment(Request $request){
        try{
            $stripe = new \Stripe\StripeClient(
                env('STRIPE_SECRET')
            );
            $res = $stripe->tokens->create(array(
                [
                    'card' => [
                        'number' => $request->number,
                        'exp_month' => $request->exp_month,
                        'exp_year' => $request->exp_year,
                        'cvc' => $request->cvc,
                    ],
                    ]
            ));
          
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $response = $stripe->charges->create([
                'amount' => $request->amount,
                'currency' => 'usd',
                'source' => $res->id,
                'description' => $request->description,
            ]);

            return $response;
        }catch(Exception $e){
            return 0;
        }

    }
}

