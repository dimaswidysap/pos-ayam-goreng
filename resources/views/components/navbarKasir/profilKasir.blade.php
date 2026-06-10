<section class="h-[80%] flex gap-2">
    <figure class="h-full aspect-square shadow-xl rounded-full"></figure>
    <div class="flex flex-col h-full justify-center">
        <strong class='text-text'>{{ strtoupper(substr(Auth::user()->name ?? 'K', 0, 1)) }}</strong>
        <span class='text-[13px] text-text -translate-y-[5px]'>{{ Auth::user()->role }}</span>
    </div>
</section>
