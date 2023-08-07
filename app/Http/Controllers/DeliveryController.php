<?php

namespace App\Http\Controllers;

use App\Models\AccountingIn;
use App\Models\AccountingOut;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function delivery ($id) {
        $accountingOut = AccountingOut::where('accounting_ins_id', $id)->with('user')->orderBy('status')->get();
        if (!$accountingOut){
            $accountingOut = [];
        }
        $totalAmount = AccountingOut::where('accounting_ins_id', $id)
            ->where('status', true) // Фильтрация по статусу true
            ->sum('amount_kz');
        return view('delivery')->with(compact('accountingOut', 'totalAmount'));
    }
    public function addDelivery (Request $request) {
        $accountingOut = new AccountingOut();
        $accountingOut->amount_kz = $request->amount_kz;
        $accountingOut->accounting_ins_id = $request->accounting_ins_id;
        $accountingOut->user_id = $request->user_id;
        $accountingOut->weight = $request->weight;
        $accountingOut->note = $request->note;
        $accountingOut->save();
        $accountingInIsDone = AccountingOut::where('accounting_ins_id', $request->accounting_ins_id)->where('status', false)->first();
        if($accountingInIsDone){
            $accountingIn = AccountingIn::find($accountingOut->accounting_ins_id);
            $accountingIn->status = false;
            $accountingIn->save();
        }
        return redirect('dashboard')->with('message', 'Новая выдача добавлена');
    }

    public function deliveryOut ($id) {
        $accountingOut = AccountingOut::find($id);
        $accountingOut->status = true;
        $accountingOut->save();

        $accountingInIsDone = AccountingOut::where('accounting_ins_id', $accountingOut->accounting_ins_id)->where('status', false)->first();
        if(!$accountingInIsDone){
            $accountingIn = AccountingIn::find($accountingOut->accounting_ins_id);
            $accountingIn->status = true;
            $accountingIn->save();
        }
        return back()->with('message', 'Товары выданы');
    }
}
