@props(['href' => null])

<div class="mb-4">
    @if($href)
        <a href="{{ $href }}" class="flex items-center text-blue-600 hover:text-blue-800 transition">
    @else
        <button onclick="history.back()" class="flex items-center text-blue-600 hover:text-blue-800 transition">
    @endif
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        <span class="text-sm md:text-base">Voltar</span>
    @if($href)
        </a>
    @else
        </button>
    @endif
</div> 