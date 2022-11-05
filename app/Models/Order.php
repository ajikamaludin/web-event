<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    //0 not paid, 1 pending, 2 success, 3 timeout
    const STATUS_NOT_PAID = 0;
    const STATUS_PENDING  = 1;
    const STATUS_PAID = 2;
    const STATUS_FAIL = 3;

    const CHANNEL_MANUAL = 0;

    protected $fillable = [
        'order_id',
        'order_date',
        'order_payment',
        'order_payment_channel',
        'order_status',
        'name',
        'address',
        'email',
        'phone_number',
        'is_checked',
    ];
}
