<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Voucher;

class VoucherRedeem extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'voucher_id',
    ];

    public function voucher() {
        return $this->belongsTo(Voucher::class);
    }
}
