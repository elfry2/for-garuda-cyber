<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'tenant_id',
        'quantity',
    ];
}
