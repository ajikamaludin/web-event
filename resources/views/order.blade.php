@extends('layouts.home') 
@section('content')

<div class="flex w-full justify-center">
    <div class="flex flex-col">
        <div class="form-control w-full max-w-xs">
            <label class="label">
                <span class="label-text">Nama</span>
            </label>
            <input type="text" placeholder="Nama" class="input input-bordered w-full max-w-xs" />
        </div>
        <div class="form-control w-full max-w-xs">
            <label class="label">
                <span class="label-text">Alamat</span>
            </label>
            <input type="text" placeholder="Alamat" class="input input-bordered w-full max-w-xs" />
        </div>
        <div class="form-control w-full max-w-xs">
            <label class="label">
                <span class="label-text">No HP/WA</span>
            </label>
            <input type="text" placeholder="No HP/WA" class="input input-bordered w-full max-w-xs" />
        </div>
        <div class="form-control w-full max-w-xs">
            <label class="label">
                <span class="label-text">Email</span>
            </label>
            <input type="text" placeholder="Email" class="input input-bordered w-full max-w-xs" />
        </div>
        <div class="pt-4">
            <button class="btn w-full">Kirim</button>
        </div>
    </div>
</div>

@endsection