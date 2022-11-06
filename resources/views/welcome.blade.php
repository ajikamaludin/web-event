@extends('layouts.home') 
@section('content')

<div class="w-full">
    <div class="carousel w-full">
        <img
            class="object-fill w-full lg:h-100 md:h-96 h-40"
            src="{{ $template->where('content_name', 'IMAGE_BANNER_2')->first()->image_url }}"
        />
        <!-- <div id="slide1" class="carousel-item relative w-full xl:h-200">
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
        </div> -->
        <!-- <div id="slide2" class="carousel-item relative w-full xl:h-200">
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
        </div> -->
    </div>
</div>
<div class="text-center pt-20" id="section2">
    <div class="text-4xl font-bold">
        <div>{{ $template->where('content_name', 'TITLE_1')->first()->content }}</div>
        <div>{{ $template->where('content_name', 'TITLE_1_1')->first()->content }}</div>
    </div>
    <div class="pt-15 text-2xl">
        {{ $template->where('content_name', 'SUB_TITLE_1')->first()->content }}
    </div>
    <div class="flex w-full justify-center py-10 space-x-4">
        <img
            class="object-fill w-1/2 h-40 md:h-96"
            src="{{ $template->where('content_name', 'IMAGE_1')->first()->image_url }}"
        />
        <img
            class="object-fill w-1/2 h-40 md:h-96"
            src="{{ $template->where('content_name', 'IMAGE_2')->first()->image_url }}"
        />
    </div>
    <div class="pt-15 text-2xl">
        {{ $template->where('content_name', 'SUB_TITLE_2')->first()->content }}
    </div>
</div>
<div class="text-center pt-20" id="section3">
    <div class="text-4xl font-bold">{{ $template->where('content_name', 'TITLE_2')->first()->content }}</div>
    <div class="w-full flex justify-center pt-10">
        <iframe
            width="800"
            height="400"
            src="{{$template->where('content_name', 'YT_1')->first()->content}}"
            title="Supervisin' Ryan with 1Password"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
        ></iframe>
    </div>
</div>
<div class="text-center pt-20">
    <div class="text-4xl font-bold">{{$template->where('content_name', 'TITLE_3')->first()->content}}</div>
    <div class="text-left md:pl-24 lg:pl-64">
        {!! $template->where('content_name', 'SUB_TITLE_3')->first()->content !!}
    </div>
    <div class="w-full flex justify-center pt-10">
        <iframe
            width="800"
            height="400"
            src="{{$template->where('content_name', 'YT_2')->first()->content}}"
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
