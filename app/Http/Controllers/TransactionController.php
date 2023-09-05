<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public static function changeBalance( $userId, float|int $amount, int $type)
    {
        $user = User::findOrFail($userId);

        switch ($type) {
            case 1:
                $user->update(['balance' => $user->balance + $amount]);
                break;
            case 2:
                $user->update(['balance' => $user->balance - $amount]);
                break;
            default:
                break;
        }

        Transaction::create([
            'type_id' => $type,
            'user_id' => $user->id,
            'amount' => $amount
        ]);
    }

    public static function showTransactions($userId)
    {
        $user = User::findOrFail($userId);

        return $user->transactions;
    }
}
