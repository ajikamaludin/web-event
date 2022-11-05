@extends('layouts.home') 

@section('content')
<div class="flex w-full justify-center py-5 h-200">
    <div class="flex flex-col">
        <div class="w-full text-center text-2xl font-bold mb-10">
            Order: {{ $order->order_id }}
        </div>
        <div class="w-full text-center">
            <div>Order atas nama <span class="font-bold">{{ $order->name }}</span> dengan no. hp/wa <span class="font-bold">{{ $order->phone_number }}</span></div>
            <div class="font-bold">Total Pembayaran (IDR) : {{ number_format($order->order_amount, 0, ',', '.') }}</div>
        </div>
        @if($order->order_status != App\Models\Order::STATUS_NOT_PAID)
        <div class="alert alert-info shadow-lg mt-10">
            <span class="font-bold text-lg">{{$order->order_status_text}}</span>
        </div>
        @endif
        @if($order->order_status == App\Models\Order::STATUS_PAID)
            <div class="mt-10 w-full flex flex-col items-center">
                <div>{!! DNS1D::getBarcodeHTML($order->order_id, 'CODABAR') !!}</div>
                <div class="text-sm">{{ $order->order_id }}</div>
            </div>
            <div class="text-sm text-center pt-10">
                silahkan screenshot tampilan layar anda untuk ditukarkan dengan tiket fisik secara OTS
            </div>
        @endif
        @if($order->order_status == App\Models\Order::STATUS_NOT_PAID)
        <div class="w-full flex justify-center mt-4">
            <div class="btn" id="btn-pay">Bayar</div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ $snap_url }}" data-client-key="{{ $setting->midtrans_client_key }}"></script>
<script>
    const payBtn = document.getElementById('btn-pay')
    payBtn.addEventListener('click', (event) => {
        snap.pay('{{ $token }}',{
            onSuccess: function(result){
                console.log('success');
                console.log(result);
                window.location.href = '{{ route("midtrans.finish") }}?order_id=' + result.order_id + '&transaction_status=' + result.transaction_status
            },
            onPending: function(result){
                console.log('pending');
                console.log(result);
                window.location.href = '{{ route("midtrans.finish") }}?order_id=' + result.order_id + '&transaction_status=' + result.transaction_status
            },
            onError: function(result){
                alert(error)
                console.log('error');
                console.log(result);
            },
            onClose: function(){
                window.location.href = '{{ route("home") }}'
                console.log('customer closed the popup without finishing the payment');
            }
        })
    })
</script>
@endsection