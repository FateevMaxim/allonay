<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount_kz',
        'amount_usd',
        'weight',
        'note',
        'status'
    ];

    public function accountingOuts()
    {
        return $this->hasMany(AccountingOut::class, 'accounting_ins_id');
    }
}
