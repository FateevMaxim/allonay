<?php

namespace App\Http\Controllers;

use App\Models\AccountingIn;
use App\Models\AccountingOut;
use App\Models\User;
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

        $userLogin = User::find($request->user_id);
        return redirect('dashboard')->with('message', 'Новая выдача добалена! <a href="https://wa.me/'.$userLogin->login.'?text=Здравствуйте, '.$request->weight. ' кг. '.$request->amount_kz.' тг.
(Тариф 4.5$). При оплате на Каспий - +1% к этой сумме. Выдача сегодня до 16:00 на рынке Жетысу" target="_blank">Пнуть</a>');
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

    public function deliveryOutUsers ($id) {
        $accountingOut = AccountingOut::where('user_id', $id)->where('status', false)->get();
        if (!$accountingOut){
            $accountingOut = [];
        }

        $totalAmount = AccountingOut::where('user_id', $id)
            ->where('status', false) // Фильтрация по статусу true
            ->sum('amount_kz');
        $kaspi = $totalAmount + $totalAmount * 0.01 ;
        return view('delivery')->with(compact('accountingOut', 'totalAmount', 'kaspi'));
    }
}
