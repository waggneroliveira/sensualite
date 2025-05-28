<div class="row">
    <div class="row">
        <!-- Nome -->
        <div class="mb-2 text-dark">
            <strong>Nome:</strong> {{ isset($companion) ? $companion->name : '-' }}
        </div>

        <!-- Email -->
        <div class="mb-2 text-dark">
            <strong>Email:</strong> {{ isset($companion) ? $companion->email : '-' }}
        </div>

        <!-- Telefone -->
        <div class="mb-2 text-dark">
            <strong>Telefone:</strong> {{ isset($companion) ? $companion->phone : '-' }}
        </div>

        <!-- Status -->
        <div class="mb-2 text-dark">
            <strong>Status:</strong> {{ isset($companion) ? ($companion->active ? 'Ativo' : 'Inativo') : '-' }}
        </div>

        <!-- Idade -->
        <div class="mb-2 text-dark">
            <strong>Idade:</strong> {{ isset($companion) ? $companion->age . ' anos' : '-' }}
        </div>

        <!-- Altura -->
        <div class="mb-2 text-dark">
            <strong>Altura:</strong> {{ isset($companion) ? $companion->height . ' cm' : '-' }}
        </div>

        <!-- Peso -->
        <div class="mb-2 text-dark">
            <strong>Peso:</strong> {{ isset($companion) ? $companion->weight . ' kg' : '-' }}
        </div>

        <!-- Tipo Físico -->
        <div class="mb-2 text-dark">
            <strong>Tipo Físico:</strong> {{ isset($companion) ? $companion->body_type : '-' }}
        </div>

        <!-- Tipo -->
        <div class="mb-2 text-dark">
            <strong>Tipo:</strong> {{ isset($companion) ? $companion->type : '-' }}
        </div>

        <!-- Disponibilidade -->
        <div class="mb-2 text-dark">
            <strong>Disponibilidade:</strong> {{ isset($companion) ? $companion->availability : '-' }}
        </div>

        <!-- Locais de Encontro -->
        <div class="mb-2 text-dark">
            <strong>Locais de Encontro:</strong> {{ isset($companion) ? $companion->meeting_places : '-' }}
        </div>

        <!-- Cor dos Olhos -->
        <div class="mb-2 text-dark">
            <strong>Cor dos Olhos:</strong> {{ isset($companion) ? $companion->eye_color : '-' }}
        </div>

        <!-- Valor -->
        <div class="mb-2 text-dark">
            <strong>Valor:</strong> {{ isset($companion) ? 'R$ ' . number_format($companion->rate, 2, ',', '.') : '-' }}
        </div>

        <!-- Métodos de Pagamento -->
        <div class="mb-2 text-dark">
            <strong>Métodos de Pagamento:</strong> {{ isset($companion) ? $companion->payment_methods : '-' }}
        </div>

        <!-- Disponível para Viagens -->
        <div class="mb-2 text-dark">
            <strong>Disponível para Viagens:</strong> {{ isset($companion) ? ($companion->available_for_travel ? 'Sim' : 'Não') : '-' }}
        </div>
    </div>
</div>
