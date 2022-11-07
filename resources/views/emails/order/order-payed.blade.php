<x-mail::message>
# Pembayaran Berhasil

Sdr {{ $order->name }} ({{ $order->phone_number }}), 

No Order      : {{ $order->order_id }} <br/>
Tanggal      : {{ $order->order_date }} <br/>
Tiket         : {{ $order->ticket->name }} ({{ number_format($order->ticket_price, 0, ",", ".") }}) x {{ $order->ticket_count }} <br/>
Total Tagihan : {{ number_format($order->order_amount, 0, ",", ".") }} <br/>

Order anda berhasil dibuat dan telah berhasil terbayar LUNAS. 
<div class="text-sm text-center pt-10">
    dapatkan kode ticket anda kemudian, screenshot tampilan layar anda untuk ditukarkan dengan tiket fisik secara OTS.
</div>

<x-mail::button :url="$url">
Dapatkan Kode
</x-mail::button>


Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>
