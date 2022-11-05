@extends('layouts.home') 
@section('content')

<div class="w-full">
    <div class="carousel w-full">
        <div id="slide1" class="carousel-item relative w-full xl:h-200">
            <img src="images/sample.jpeg" class="w-full" />
            <div
                class="absolute self-center transform -translate-y-1/2 left-5 right-5 top-3/4"
            >
                <p class="text-white font-bold text-shadow p-2 w-full text-2xl">
                    Event Konser Termeriah Abad ini
                </p>
            </div>
            <div
                class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2"
            >
                <a href="#slide2" class="btn btn-circle">❮</a>
                <a href="#slide2" class="btn btn-circle">❯</a>
            </div>
        </div>
        <div id="slide2" class="carousel-item relative w-full xl:h-200">
            <img src="images/sample.jpeg" class="w-full" />
            <div
                class="absolute self-center transform -translate-y-1/2 left-5 right-5 top-3/4"
            >
                <div class="text-white font-bold text-xl text-shadow p-2">
                    Meriahkan dan Saksikan Penampilan Sperktakuler dari SITI
                    BADRIAH dan Babang Tamvan
                </div>
            </div>
            <div
                class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2"
            >
                <a href="#slide1" class="btn btn-circle">❮</a>
                <a href="#slide1" class="btn btn-circle">❯</a>
            </div>
        </div>
    </div>
</div>
<div class="text-center pt-20" id="section2">
    <div class="text-4xl font-bold">
        <div>FALENTAIN BERSAMA</div>
        <div>SITI BADRIAH VS ANDIKA MAHESA (KANGEN BAND)</div>
    </div>
    <div class="pt-15 text-2xl">
        MERIAHKAN DAN SAKSIKAN PENAMPILAN SPERKTAKULER DARI SITI BADRIAH DAN
        ANDIKA KANGEN BAND
    </div>
    <div class="flex w-full justify-center py-10 space-x-4">
        <img
            class="object-fill w-1/2 h-40 md:h-96"
            src="images/babang-tamvan.jpg"
        />
        <img
            class="object-fill w-1/2 h-40 md:h-96"
            src="images/siti-badriah.jpg"
        />
    </div>
    <div class="pt-15 text-2xl">
        JANGAN KETINGGALAN MOMEN FALENTINE YANG SUPER SERU DAN SPEKTAKULER
        BERSAMA PASANGAN. SAHABAT DAN KELUARGA DI MERIHKAN ARTIS YANG SEDANG
        HITS YAKNI SITI BADRIA DAN ANDIKA MAHESA ( KANGEN BAND )
    </div>
</div>
<div class="text-center pt-20" id="section3">
    <div class="text-4xl font-bold">INTIP PENAMPILAN MEREKA</div>
    <div class="w-full flex justify-center pt-10">
        <iframe
            width="800"
            height="400"
            src="https://www.youtube.com/embed/3bGNgU-2aBs"
            title="Supervisin' Ryan with 1Password"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
        ></iframe>
    </div>
</div>
<div class="text-center pt-20">
    <div class="text-4xl font-bold">TIKET 50RB</div>
    <div class="text-left md:pl-24 lg:pl-64">
        <ul class="list-disc text-lg">
            <li>DAPAT TIKET LIVE KONSER</li>
            <li>DAPAT VOUCHER UNDIAN</li>
            <li>DAPAT VOUCHER RP. 1.500.000,- di perumahan afika residence</li>
        </ul>
    </div>
    <div class="w-full flex justify-center pt-10">
        <iframe
            width="800"
            height="400"
            src="https://www.youtube.com/embed/3bGNgU-2aBs"
            title="Supervisin' Ryan with 1Password"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
        ></iframe>
    </div>
    <a
        href="{{ route('order') }}"
        class="btn btn-info text-white w-full lg:w-1/2 mt-10"
        id="pesan"
    >
        PESAN TIKET
    </a>
</div>

@endsection
