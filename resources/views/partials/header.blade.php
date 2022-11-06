<div class="flex justify-between" id="section1">
    <div class="flex justify-between space-x-5">
        <a href="{{ route('home') }}" class="w-40 h-24">
            <img src="{{ $template->where('content_name', 'LOGO_1')->first()->image_url }}" />
        </a>
        <a href="{{ route('home') }}" class="w-40 h-24">
            <img src="{{ $template->where('content_name', 'LOGO_2')->first()->image_url }}" />
        </a>
    </div>
    <div class="md:flex space-x-2 hidden">
        <a href="{{ route('home') }}" class="btn btn-ghost">Home</a>
        <a href="#pesan" class="btn btn-ghost">Pesan</a>
    </div>
</div>