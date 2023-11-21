<?php

namespace App\Http\Controllers;

use App\Models\AccountingIn;
use App\Models\Configuration;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class AccountingController extends Controller
{
    public function accounting () {
        $accountingIn = AccountingIn::query()->orderByDesc('id')->get();
        return view('accounting')->with(compact('accountingIn'));
    }
    public function addAccountingIn (Request $request) {
        $config = Configuration::query()->select('rate')->first();
        $amount_kz = $request->amount_usd * $config->rate;
        $accountingIn = new AccountingIn();
        $accountingIn->amount_usd = $request->amount_usd;
        $accountingIn->amount_kz = $amount_kz;
        $accountingIn->weight = $request->weight;
        $accountingIn->note = $request->note;
        $accountingIn->save();
        return redirect('accounting')->with('message', 'Новый приход добавлен');

    }
    public function editAccountingIn ($id) {

        $accountingIn = AccountingIn::find($id);
        return view('edit-accounting')->with(compact('accountingIn'));
    }


    public function editAccountingInPost (Request $request) {
        $config = Configuration::query()->select('rate')->first();
        $amount_kz = $request["amount_usd"] * $config->rate;
        $accountingIn = AccountingIn::find($request["id"]);
        $accountingIn->amount_usd = $request["amount_usd"];
        $accountingIn->amount_kz = $amount_kz;
        $accountingIn->weight = $request["weight"];
        $accountingIn->note = $request["note"];
        $accountingIn->status = (bool)$request["status"];
        $accountingIn->save();
        return redirect('accounting')->with('message', 'Данные о приходе обновлены');

    }

    public function addAccountingWithdraw (Request $request) {
        $withdraw = new Withdraw();
        $withdraw->amount = $request->amount;
        $withdraw->note = $request->note;
        $withdraw->save();
        return redirect('accounting-result')->with('message', 'Новый расход добавлен');

    }
}
