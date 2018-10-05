<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use App\Topup;
use App\Transaction;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
    	$users = Auth::user();
    	$transactions = Transaction::all()->where('user_id', $users->id);
        return view( 'transaksi.index', compact('transactions', 'users'));
    }
}
