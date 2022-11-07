<?php
namespace App\Services;

use App\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    protected $order;

    public function __construct(Order $order, $serverKey, $isProduction)
    {
        Config::$overrideNotifUrl = route('midtrans.callback');
        Config::$serverKey = $serverKey;
        Config::$isProduction = $isProduction;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $this->order = $order;
    }

    public function getSnapToken()
    {
        $params = [
            'transaction_details' => [
                'order_id' => $this->order->order_id,
                'gross_amount' => $this->order->order_amount,
            ],
            'item_details' => [
                [
                    'id' => $this->order->order_id,
                    'price' => $this->order->ticket_price,
                    'quantity' => $this->order->ticket_count,
                    'name' => 'Tiket-'.$this->order->ticket->name,
                ],
            ],
            'customer_details' => [
                'first_name' => $this->order->name,
                'email' => $this->order->email,
                'phone' => $this->order->phone_number,
                'billing_address'  => $this->order->address,
                'shipping_address' => $this->order->address,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}
