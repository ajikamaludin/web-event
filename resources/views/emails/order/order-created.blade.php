<x-mail::message>
# Pesanan Anda Berhasil Dibuat

Sdr {{ $order->name }}({{ $order->phone_number }}), 

No Order      : {{ $order->order_id }} <br/>
Tanggal      : {{ $order->order_date }} <br/>
Total Tagihan : {{ $order->order_amount }} <br/>

order anda berhasil dibuat mohon segera melakukan pembayaran sebelum waktu order berakhir. 

<x-mail::button :url="$url">
Bayar
</x-mail::button>

Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>
