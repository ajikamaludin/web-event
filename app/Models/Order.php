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

    const HAS_BEEN_CHECK = 1;

    const CHANNEL_MANUAL = 'Admin | Manual';

    protected $fillable = [
        'order_id',
        'order_date',
        'order_amount',
        'order_payment', // date of pay
        'order_payment_channel',
        'order_status',
        'name',
        'address',
        'email',
        'phone_number',
        'is_checked', // person ticket has been change to phisical
        'midtrans_detail_callback',
    ];

    protected $appends = ['order_status_text'];

    public function getOrderStatusTextAttribute()
    {
        return [
            self::STATUS_NOT_PAID => 'Belum dibayar',
            self::STATUS_PENDING => 'Pending',
            self::STATUS_PAID => 'Terbayar',
            self::STATUS_FAIL => 'Pembayaran Gagal',
        ][$this->order_status] ." | ". ($this->is_checked == 1 ? 'Sudah Scan' : 'Belum Scan');
    }
}
