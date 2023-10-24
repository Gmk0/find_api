<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tools\Paiement;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    //


    public function checkoutmaxi(Request $request)
    {

        $request->items;

        try {
            $user=$request->user();

            $data = $request->items;
            $total =$request->totalprice;
            $name=$request->name;
            $numero =$request->numero;


            $succesUrl = 'http://localhost:3000/checkout/service/status';
            $faileurUrl = 'http://localhost:3000/checkout/service/status';

            $cancelurl = 'http://localhost:3000/checkout/service/status';
            $checkout = new Paiement();
            $payment = new Transaction();
            $payment->user_id = $user->id;
            $payment->amount
                = $total;
            $payment->payment_method = ['last4' => "", 'brand' => "maxicash"];
            $payment->payment_token = $this->references();
            $payment->type = "paiement";
            $payment->save();

            return $checkout->checkoutmaxi($total*100,$numero, $payment->payment_token, $succesUrl, $cancelurl, $faileurUrl);
        } catch (\Exception $e) {

            return response()->json(['error'=>$e->getMessage()],422);

            //$this->dispatch('error', ['message' => $e->getMessage(), 'title' => 'Error',  'icon' => 'error']);
        }
    }


    public function checkoutMaxiStatus(Request $request)
    {
        $request->validate([
            'reference' => ['required'],
            'status' => ['required']
        ]);

        try{

            $reference=$request->reference;
            $methode = $request->method;
            $status = $request->status;

            $transaction = Transaction::where('payment_token', $reference)->first();

            if ($transaction  == null) {
                return response()->json(['message' => 'Transaction n\'existe pas'], 422);
            }

            if($status == 'failed')
            {
                $transaction->status= 'failed';
                $transaction->save();

                return response()->json(['message' => 'la transaction a echouer'], 422);

            }else if($status == 'success'){

                if($transaction->status === 'success')
                {
                    return response()->json(['message' => 'le transaction de la status n\'as pas ete changer'], 422);
                }

                $transaction->status = 'completed';
                $transaction->save();

                 return response()->json($transaction);

            }else{
                return response()->json(['message' => 'la transaction a echouer'], 422);
            }

        }catch(\Exception $e){

            return response()->json(['message' => $e->getMessage()], 422);

        }
    }

    function references()
    {
        // Générer une chaîne aléatoire unique de 16 caractères
        $randomString = uniqid();
        // Extraire les 8 premiers caractères de la chaîne aléatoire pour obtenir l'ID unique de 8 caractères
        $uniqueId = substr($randomString, 0, 8);
        // Compteur pour incrémenter la fin de l'ID unique
        $counter = DB::table('transactions')->count() + 1;
        // Concaténer le compteur à la fin de l'ID unique
        return  $finalId = 'TR' . $uniqueId . $counter;
    }


}
