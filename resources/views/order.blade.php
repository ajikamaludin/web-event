@extends('layouts.home') 

@section('content')

<div class="flex w-full justify-center py-5 h-200">
    <div class="flex flex-col">
        <div class="w-full text-center text-2xl font-bold mb-10">
            Pesan Tiket
        </div>
        <form method="POST" action="{{ route('order.pay') }}" id="form-order">
            @csrf
            <input type="hidden" name="ordernum" value="{{ $ordernum }}">
            <div class="form-control w-full max-w-sm">
                <label class="label">
                    <span class="label-text">Nama</span>
                </label>
                <input name="name" type="text" htmlFor="name" value="{{ old('name') }}" placeholder="Nama" class="input input-bordered w-full max-w-sm @error('name') input-error @enderror" id="nama" require/>
                @error('name')
                <label class="label">
                    <span class="text-xs text-red-600">{{ $message }}</span>
                </label>
                @enderror
            </div>
            <div class="form-control w-full max-w-sm">
                <label class="label">
                    <span class="label-text">Alamat</span>
                </label>
                <input name="address" type="text" placeholder="Alamat" value="{{ old('address') }}" class="input input-bordered w-full max-w-sm @error('address') input-error @enderror" required/>
                @error('address')
                <label class="label">
                    <span class="text-xs text-red-600">{{ $message }}</span>
                </label>
                @enderror
            </div>
            <div class="form-control w-full max-w-sm">
                <label class="label">
                    <span class="label-text">No HP/WA</span>
                </label>
                <input name="phone_number" type="tel" placeholder="No HP/WA" value="{{ old('phone_number') }}" class="input input-bordered w-full max-w-sm @error('phone_number') input-error @enderror" id="wa" required/>
                @error('phone_number')
                <label class="label">
                    <span class="text-xs text-red-600">{{ $message }}</span>
                </label>
                @enderror
            </div>
            <div class="form-control w-full max-w-sm">
                <label class="label">
                    <span class="label-text">Email</span>
                </label>
                <input name="email" type="email" placeholder="Email" value="{{ old('email') }}" class="input input-bordered w-full max-w-sm @error('email') input-error @enderror" required/>
                @error('email')
                <label class="label">
                    <span class="text-xs text-red-600">{{ $message }}</span>
                </label>
                @enderror
            </div>
            <div class="form-control w-full max-w-sm">
                <label class="label">
                    <span class="label-text">Tiket</span>
                </label>
                <select class="select select-bordered w-full" name="ticket_id" id="ticket">
                    @foreach($tickets as $index => $ticket)
                    <option {{ $index == "0" ? "selected" : "" }} value="{{ $ticket->id }}" data-price="{{ $ticket->price }}">{{ $ticket->name }} ({{ number_format($ticket->price, 0, ',', '.') }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-control w-full max-w-sm">
                <label class="label">
                    <span class="label-text">Jumlah</span>
                </label>
                <input name="count" value="1" min="1" type="number" placeholder="Jumlah" value="{{ old('count') }}" class="input input-bordered w-full max-w-sm @error('count') input-error @enderror" id="count" required/>
                @error('count')
                <label class="label">
                    <span class="text-xs text-red-600">{{ $message }}</span>
                </label>
                @enderror
            </div>
            <div class="form-control mt-4 w-full max-w-sm">
                <div class="flex space-x-2"> 
                    <input type="radio" checked="checked" />
                    <span class="label-text">Pembayaran Indonesia</span> 
                </div>
                <p class="text-sm">Pilihan pemesanan ada pada halaman selanjutnya, data pribadi anda akan digunaan untuk proses pemesanan anda</p>
            </div>
            <div class="form-control mt-4 w-full max-w-sm">
                <div class="flex space-x-2">
                    <input type="checkbox" id="agree" />
                    <span class="label-text">Saya telah membaca dan setuju dengan <a href="{{ $setting->term_url }}" target="_blank" class="underline"> syarat dan ketentuan</a>*</span> 
                </div>
            </div>
        </form>
        <div class="pt-4">
            <button class="btn w-full" id="btn-buy" disabled="true">Beli</button>
        </div>
    </div>
</div>

<!-- Put this part before </body> tag -->
<input type="checkbox" id="my-modal" class="modal-toggle" />
<div class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-xl">Konfirmasi Pesanan!</h3>
        <p class="pt-4 pb-1">No.Order: {{ $ordernum }}</p>
        <p class="py-1" id="data"></p>
        <p class="py-1 font-bold" id="total">Total: ? (IDR)</p>
        <p class="py-1">Dengan ini data yang saya inputkan sudah benar dan valid</p>
        <div class="modal-action">
            <button class="btn" id="btn-pay">Bayar</button>
            <button class="btn btn-secondary" id="btn-cancel">Batal</button>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    const buyButton = document.querySelector('#btn-buy');
    const payButton = document.querySelector('#btn-pay');
    const cancelButton = document.querySelector('#btn-cancel');
    const modalCheck = document.querySelector('#my-modal')
    const formOrder = document.querySelector('#form-order')
    const data = document.querySelector('#data')
    const agree = document.querySelector('#agree')

    agree.addEventListener('click', function(e) {
        if(!agree.checked){
            buyButton.disabled = true
        } else {
            buyButton.disabled = false
        }
    })

    buyButton.addEventListener('click', function(e) {
        e.preventDefault();
        console.log('buy')
        const nama = document.querySelector('#nama')
        const wa = document.querySelector('#wa')
        const ticket = document.querySelector('#ticket')
        const count = document.querySelector('#count')
        const total = document.querySelector('#total')
        if (nama.value == '' || wa.value == '') {
            alert('form tidak boleh kosong')
            return
        }
        price = ticket.options[ticket.selectedIndex].getAttribute("data-price")
        amount = count.value * price
        total.textContent = "Total: " + formatIDR(amount) + " (IDR)"
        data.textContent = nama.value + ' / ' + wa.value
        modalCheck.click()
    })

    cancelButton.addEventListener('click', function(e) {
        e.preventDefault();
        console.log('cancel')
        modalCheck.click()
    })

    payButton.addEventListener('click', function(e) {
        e.preventDefault();
        console.log('pay')
        formOrder.submit()

    })

    function formatIDR(amount) {
        const idFormatter = new Intl.NumberFormat("id-ID");
        return idFormatter.format(amount);
    }
</script>
@endsection