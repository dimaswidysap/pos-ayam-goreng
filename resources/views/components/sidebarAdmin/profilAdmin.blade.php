<section class="h-[80%] flex gap-2">
    <figure class="h-full aspect-square shadow-xl rounded-full flex justify-center items-center text-accent">
        <svg xmlns="http://www.w3.org/2000/svg"
     width="24"
     height="24"
     viewBox="0 0 24 24"
     fill="currentColor">
    <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5zm0 2c-4.42 0-8 2.24-8 5v1h16v-1c0-2.76-3.58-5-8-5z"/>
</svg>
    </figure>
    <div class="flex flex-col h-full justify-center">
        <strong class='text-text'>{{  Auth::user()->name }}</strong>
        <span class='text-[13px] text-text -translate-y-1.25'>{{ Auth::user()->role }}</span>
    </div>
</section>
