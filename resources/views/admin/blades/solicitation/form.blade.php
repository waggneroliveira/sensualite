<div class="mb-3">
    <label for="title" class="form-label">Nome da galeria</label>
    <input type="text" class="form-control-input d-block w-100 p-2" id="title{{isset($solicitation->id)?$solicitation->id:''}}" value="{{isset($solicitation)?$solicitation->title:''}}" readonly>
</div>

<div class="mb-3">
    <label class="mb-3">Imagens</label>
    <div class="row g-3">
        @if ($solicitation)                
            @foreach ($solicitation->galleryFile as $index => $path)                
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card">
                        <a href="#" 
                           class="gallery-link" 
                           data-bs-toggle="modal" 
                           data-bs-target="#imageModal-{{$solicitation->id}}" 
                           data-index="{{ $index }}"
                           data-image="{{ asset('storage/' . $path->file) }}">
                            <img src="{{ asset('storage/' . $path->file) }}" class="card-img-top gallery-img" alt="Imagem {{ $index + 1 }}">
                        </a>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="imageModal-{{$solicitation->id}}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg m-auto w-100" style="max-width: 90%">
                        <div class="modal-content position-relative bg-dark">
                            
                            <button style="z-index: 100;" type="button" class="btn btn-light position-absolute top-0 end-0 m-3 px-3 py-1 fw-bold" 
                                    data-bs-dismiss="modal" aria-label="Fechar">
                                &times;
                            </button>


                            <div class="modal-body p-0 text-center">
                                <img id="modalImage" src="{{ asset('storage/' . $path->file) }}" class="modal-img" alt="Imagem ampliada">
                                <!-- Navegação -->
                                <button type="button" class="btn btn-light position-absolute top-50 start-0 translate-middle-y px-3" id="prevBtn">&larr;</button>
                                <button type="button" class="btn btn-light position-absolute top-50 end-0 translate-middle-y px-3" id="nextBtn">&rarr;</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@if ($canAprovar)    
    <div class="d-flex justify-content-end align-items-center gap-3">
        <button type="button" class="geex-btn geex-btn--primary" data-bs-toggle="modal" data-bs-target="#solicitation-create"> Reprovar galeria</button>
        
        <form action="{{route('admin.dashboard.aprove', $solicitation->id)}}" method="post">
            @csrf
            @method('put')
            <button type="submit" class="geex-btn geex-btn--primary"></i> Aprovar galeria</button>
        </form>
    </div>
@endif

@if ($canReprovar)    
    <!-- Modal -->
    <div class="modal fade" id="solicitation-create" tabindex="-1" role="dialog" aria-hidden="true" style="background: #000000bf;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title" id="myCenterModalLabel">Reprovar</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{route('admin.dashboard.reprove', $solicitation->id)}}" method="post">
                        @csrf
                        @method('put')
                        <textarea name="reason" class="w-100"  placeholder="Motivo da rejeição (opcional)"></textarea>
                        <button type="submit" class="geex-btn geex-btn--primary"></i> Reprovar</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endif

<!-- Estilo para manter imagem quadrada na galeria -->
<style>
    .modal-img {
        max-width: 100%;
        max-height: 100dvh;
        object-fit: contain;
        width: auto;
        height: auto;
        margin: auto;
        display: block;
    }
    .gallery-img {
        aspect-ratio: 1 / 1;
        object-fit: cover;
    }
</style>

<!-- Script -->
<script>
    (function () {
        const galleryLinks = document.querySelectorAll('.gallery-link');
    
        galleryLinks.forEach(link => {
            link.addEventListener('click', function () {
                const modalId = this.getAttribute('data-bs-target').replace('#', '');
                const modalElement = document.getElementById(modalId);
    
                if (!modalElement) return;
    
                const modalImage = modalElement.querySelector('#modalImage');
                const prevBtn = modalElement.querySelector('#prevBtn');
                const nextBtn = modalElement.querySelector('#nextBtn');
    
                const images = Array.from(document.querySelectorAll(`[data-bs-target="#${modalId}"]`))
                    .map(el => el.dataset.image);
                let currentIndex = parseInt(this.getAttribute('data-index'));
    
                const updateImage = () => {
                    modalImage.src = images[currentIndex];
                };
    
                // Remove listeners antigos antes de adicionar novos
                const newPrevBtn = prevBtn.cloneNode(true);
                const newNextBtn = nextBtn.cloneNode(true);
                prevBtn.replaceWith(newPrevBtn);
                nextBtn.replaceWith(newNextBtn);
    
                newPrevBtn.addEventListener('click', function () {
                    currentIndex = (currentIndex - 1 + images.length) % images.length;
                    updateImage();
                });
    
                newNextBtn.addEventListener('click', function () {
                    currentIndex = (currentIndex + 1) % images.length;
                    updateImage();
                });
    
                // Atualiza imagem ao abrir modal
                modalElement.addEventListener('shown.bs.modal', function () {
                    updateImage();
                }, { once: true }); // evita múltiplas execuções
            });
        });
    })();
</script>
    
