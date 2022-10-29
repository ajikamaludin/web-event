<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    const ENV_PROD = 1;
    const OPEN_ORDER = 1;

    protected $fillables = [
        'midtrans_server_key',
        'midtrans_client_key',
        'midtrans_merchant_id',
        'midtrans_snap_prod',
        'midtrans_snap_dev',
        'site_name',
        'ticket_price',
        'is_production',
        'is_open_order',
    ];
}
