<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();
        $orders = $user->orders()->latest()->paginate(10);

        return view('account.orders', compact('orders'));
    }
}
