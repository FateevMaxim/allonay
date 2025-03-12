<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingOut extends Model
{
    use HasFactory;

    protected $fillable = [
        'accounting_ins_id',
        'user_id',
        'weight',
        'amount_kz',
        'note',
        'status',
        'type',
        'is_tracks_added'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
