<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tools\Paiement;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class UserTransactionController extends Controller
{
    //

    public function getUserTransaction(Request $request){

       try{
            $user = $request->user();


            $transations = Transaction::where('user_id', $user->id)->paginate(10);

            return response()->json($transations);

       }catch(\Exception $e){

        return response()->json(['message' => $e->getMessage(),422]);

       }


    }
}
