<x-mail::message>
# Pesanan Anda Berhasil Dibuat

Sdr {{ $order->name }} ({{ $order->phone_number }}), 

No Order      : {{ $order->order_id }} <br/>
Tanggal      : {{ $order->order_date }} <br/>
Tiket         : {{ $order->ticket->name }} ({{ number_format($order->ticket_price, 0, ",", ".") }}) x {{ $order->ticket_count }} <br/>
Total Tagihan : {{ number_format($order->order_amount, 0, ",", ".") }} <br/>

order anda berhasil dibuat mohon segera melakukan pembayaran sebelum waktu order berakhir. 

<x-mail::button :url="$url">
Bayar
</x-mail::button>

Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>
