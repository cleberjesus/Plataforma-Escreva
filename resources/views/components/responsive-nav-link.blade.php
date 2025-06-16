@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-white text-start text-base font-medium text-white focus:outline-none focus:text-white focus:border-white transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-[#4f47e600] focus:outline-none focus:text-white focus:border-white transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes, 'style' => '']) }} onmouseover="this.style.backgroundColor='rgba(79,71,230,0.08)'" onmouseout="this.style.backgroundColor=''">
    {{ $slot }}
</a>
