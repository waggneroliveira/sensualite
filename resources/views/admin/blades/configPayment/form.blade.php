<div class="row">
    <div class="mb-3">
        <label for="paymentLink" class="form-label text-dark">Link de pagamento  <span class="text-danger">*</span></label>
        @if (Auth::check() && Auth::user()->hasRole('Super'))
            <input type="text" name="api_url_payment_link" class="form-control-input d-block w-100 p-2" id="paymentLink{{isset($credentialPagarme->id)?$credentialPagarme->id:''}}" value="{{isset($credentialPagarme)?$credentialPagarme->api_url_payment_link:''}}" placeholder="Digite o link do pagamento" required>
            @else
            <input type="text" class="form-control-input d-block w-100 p-2" id="paymentLink{{isset($credentialPagarme->id)?$credentialPagarme->id:''}}" value="{{isset($credentialPagarme)?$credentialPagarme->api_url_payment_link:''}}" readonly disabled>
        @endif
    </div>

    <div class="mb-3">
        <label for="statusPayment" class="form-label text-dark">Link do status do pagamento <span class="text-danger">*</span></label>
        @if (Auth::check() && Auth::user()->hasRole('Super'))
            <input type="text" name="api_url_get_payment_status" class="form-control-input d-block w-100 p-2" id="statusPayment{{isset($credentialPagarme->id)?$credentialPagarme->id:''}}" value="{{isset($credentialPagarme)?$credentialPagarme->api_url_get_payment_status:''}}" placeholder="Digite link do status de pagamento" required>
            @else
            <input type="text" class="form-control-input d-block w-100 p-2" id="statusPayment{{isset($credentialPagarme->id)?$credentialPagarme->id:''}}" value="{{isset($credentialPagarme)?$credentialPagarme->api_url_get_payment_status:''}}" placeholder="Digite link do status de pagamento" readonly disabled>
        @endif
    </div>

    <div class="mb-3">
        <label for="password" class="form-label text-dark">Chave api <span class="text-danger">*</span></label>
        <div class="input-group input-group-merge">
            <input type="password" name="api_key" id="password-{{ isset($credentialPagarme->id) ? $credentialPagarme->id : '' }}" class="form-control-input d-block w-100 p-2" placeholder="Digite sua senha" {{ !isset($credentialPagarme) ? 'required' : '' }}>
        </div>
    </div>
</div>


