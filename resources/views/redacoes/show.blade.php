@extends('layouts.app')

@section('title', 'Visualizar Redação')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-4 lg:px-8">
        <x-back-button url="{{ route('redacoes.index') }}" />

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 sm:p-10">
                <h2 class="text-2xl font-bold mb-4 text-center text-gray-800">{{ $redacao->tema }}</h2>
                <p class="text-gray-500 text-sm mb-6 text-center">
                    Enviado em {{ $redacao->created_at->format('d/m/Y H:i') }}
                </p>

                @if ($redacao->modo_envio === 'digitado')
                    <div class="bg-gray-50 p-6 rounded-lg mb-6">
                        <p class="whitespace-pre-wrap text-gray-800">{{ $redacao->texto_redacao }}</p>
                    </div>
                @elseif ($redacao->modo_envio === 'imagem' && $redacao->imagem_redacao)
                    <div class="flex justify-center mb-6">
                        <img src="{{ asset('storage/' . $redacao->imagem_redacao) }}" class="rounded-lg shadow-md max-w-full max-h-[500px] cursor-zoom-in" id="redacao-img" alt="Imagem da Redação">
                    </div>
                @endif

                <div class="flex justify-center">
                    <a href="{{ route('redacoes.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold text-center">Voltar para a listagem</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
  /* Modal styles */
  #zoom-modal-bg {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0; top: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.8);
    justify-content: center;
    align-items: center;
  }
  #zoom-modal-bg.active {
    display: flex;
  }
  #zoom-modal-img {
    max-width: 90vw;
    max-height: 90vh;
    border-radius: 12px;
    box-shadow: 0 4px 32px rgba(0,0,0,0.5);
    transition: transform 0.2s;
    cursor: grab;
  }
  #zoom-modal-close {
    position: absolute;
    top: 32px;
    right: 48px;
    font-size: 2rem;
    color: #fff;
    background: none;
    border: none;
    cursor: pointer;
    z-index: 1010;
  }
</style>
@endpush

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const img = document.getElementById('redacao-img');
    if (!img) return;
    // Cria modal dinamicamente
    const modalBg = document.createElement('div');
    modalBg.id = 'zoom-modal-bg';
    modalBg.innerHTML = `
      <button id="zoom-modal-close" title="Fechar">&times;</button>
      <img id="zoom-modal-img" src="${img.src}" alt="Zoom Redação">
    `;
    document.body.appendChild(modalBg);
    const modalImg = modalBg.querySelector('#zoom-modal-img');
    const closeBtn = modalBg.querySelector('#zoom-modal-close');
    let scale = 1;
    let lastX = 0, lastY = 0, isDragging = false, startX = 0, startY = 0;

    // Abrir modal
    img.addEventListener('click', function () {
      modalBg.classList.add('active');
      scale = 1;
      modalImg.style.transform = 'scale(1) translate(0px,0px)';
      modalImg.src = img.src;
    });
    // Fechar modal
    function closeModal() {
      modalBg.classList.remove('active');
    }
    closeBtn.addEventListener('click', closeModal);
    modalBg.addEventListener('click', function(e) {
      if (e.target === modalBg) closeModal();
    });
    // Zoom com scroll
    modalImg.addEventListener('wheel', function(e) {
      e.preventDefault();
      const delta = e.deltaY > 0 ? -0.1 : 0.1;
      scale = Math.min(Math.max(0.5, scale + delta), 5);
      modalImg.style.transform = `scale(${scale}) translate(${lastX}px,${lastY}px)`;
    });
    // Arrastar imagem
    modalImg.addEventListener('mousedown', function(e) {
      isDragging = true;
      startX = e.clientX - lastX;
      startY = e.clientY - lastY;
      modalImg.style.cursor = 'grabbing';
    });
    document.addEventListener('mousemove', function(e) {
      if (!isDragging) return;
      lastX = e.clientX - startX;
      lastY = e.clientY - startY;
      modalImg.style.transform = `scale(${scale}) translate(${lastX}px,${lastY}px)`;
    });
    document.addEventListener('mouseup', function() {
      isDragging = false;
      modalImg.style.cursor = 'grab';
    });
    // Suporte a toque (pinça e arrastar)
    let lastTouchDist = null;
    let lastTouchX = 0, lastTouchY = 0;
    modalImg.addEventListener('touchstart', function(e) {
      if (e.touches.length === 2) {
        lastTouchDist = Math.hypot(
          e.touches[0].clientX - e.touches[1].clientX,
          e.touches[0].clientY - e.touches[1].clientY
        );
      } else if (e.touches.length === 1) {
        lastTouchX = e.touches[0].clientX - lastX;
        lastTouchY = e.touches[0].clientY - lastY;
      }
    });
    modalImg.addEventListener('touchmove', function(e) {
      if (e.touches.length === 2) {
        const dist = Math.hypot(
          e.touches[0].clientX - e.touches[1].clientX,
          e.touches[0].clientY - e.touches[1].clientY
        );
        if (lastTouchDist) {
          let delta = (dist - lastTouchDist) / 200;
          scale = Math.min(Math.max(0.5, scale + delta), 5);
          modalImg.style.transform = `scale(${scale}) translate(${lastX}px,${lastY}px)`;
        }
        lastTouchDist = dist;
      } else if (e.touches.length === 1) {
        lastX = e.touches[0].clientX - lastTouchX;
        lastY = e.touches[0].clientY - lastTouchY;
        modalImg.style.transform = `scale(${scale}) translate(${lastX}px,${lastY}px)`;
      }
      e.preventDefault();
    }, { passive: false });
    modalImg.addEventListener('touchend', function(e) {
      if (e.touches.length < 2) lastTouchDist = null;
    });
  });
</script>
@endpush 